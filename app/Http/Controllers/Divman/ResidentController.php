<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Illuminate\Http\Request;
use App\Resident;
use App\Usroh;
use App\Kamar;
use App\Tahun;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{    
    public function __construct()
    {
        $this->helper = new Helper;
        
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isdivman)
                return redirect('/s');
                
            return $next($request);
        });
    }

    public function index()
    {
        $ta = $this->helper->idTahunAktif();
        $resident = Resident::where('resident.idtahun', $ta)
                    ->where('resident.jeniskelamin', Auth::user()->jeniskelamin)
                    ->join('kamar', 'resident.idkamar', '=', 'kamar.id')
                    ->select('resident.*')
                    ->orderBy('kamar.nomor')
                    ->paginate(16);

        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.resident.index', [
                'tahun' => $tahun,
                'resident' => $resident,
            ]);
        
        return view('divman.resident.index', [
            'tahun' => $tahun,
            'resident' => $resident,
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->idTahunAktif();
        $usroh = Usroh::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();
        $tahun = $this->helper->tahunAktif();

        if($this->helper->isMobile())
            return view('m.divman.resident.tambah', [
                'tahun' => $tahun,
                'usroh' => $usroh,
            ]);
        
        return view('divman.resident.tambah', [
            'tahun' => $tahun,
            'usroh' => $usroh,
        ]);
    }

    public function tambahResident(Request $request)
    {
        
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|unique:resident,nim|digits:11',
            'idusroh' => 'required',
            'idkamar' => 'required'
        ]);

        $resident = new Resident;

        $resident->idtahun = $this->helper->idTahunAktif();
        $resident->idusroh = $request->idusroh;
        $resident->idkamar = $request->idkamar;
        $resident->nama = $request->nama;
        $resident->nim = $request->nim;
        $resident->jeniskelamin = Auth::user()->jeniskelamin;
        
        $resident->save();
        
        // Foto
        if($request->foto){
            $name = $request->id .".jpg";
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());

            $img = explode(',', $request->foto);
            $image = base64_decode($img[1]);
            file_put_contents("foto/" .$tahun. "/resident/" .$name, $image);

            $resident->foto = $name;
        }

        return redirect(route('divman.resident'))->with(['sukses' => 'Resident Baru Ditambahkan!']);
    }

    public function detail($id)
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $resident = Resident::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();

        if($resident===null) {
            return redirect(route('divman.resident'))->withErrors(['Resident Tidak Ditemukan!']);
        }

        $usroh = Usroh::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();

        if($this->helper->isMobile())
            return view('m.divman.resident.detail', [
                'resident' => $resident,
                'usroh' => $usroh,
                'tahun' => $tahun,
            ]);
        
        return view('divman.resident.detail', [
            'resident' => $resident,
            'usroh' => $usroh,
            'tahun' => $tahun,
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|digits:11',
            'idusroh' => 'required',
            'idkamar' => 'required'
        ]);

        $resident = Resident::where('id', $request->id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();

        if($resident===null) {
            return redirect(route('divman.resident'))->withErrors(['Maaf, Resident Tidak Ditemukan!']);
        }

        // Foto
        if($request->foto){
            $name = $resident->id .".jpg";
            $tahunresident = Tahun::find($resident->idtahun);
            $tahun = Str::replaceFirst('/', '-', $tahunresident->tahunajaran);

            $img = explode(',', $request->foto);
            $image = base64_decode($img[1]);
    
            if (!is_dir("storage/foto/" .$tahun. "/resident/")) {
                // dir doesn't exist, make it
                mkdir("storage/foto/" .$tahun. "/resident/", 0777, true);
            }
            
            file_put_contents("storage/foto/" .$tahun. "/resident/" .$name, $image);

            $resident->foto = $name;
        }

        $resident->idtahun = $this->helper->idTahunAktif();
        $resident->idusroh = $request->idusroh;
        $resident->idkamar = $request->idkamar;
        $resident->nama = $request->nama;
        $resident->nim = $request->nim;
        
        $resident->save();
        
        return redirect(route('divman.resident'))->with(['sukses' => 'Data Resident Telah Disimpan!']);
    }

    public function hapus($id)
    {
        $resident = Resident::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();
        
        if($resident===null) {
            return redirect(route('divman.resident'))->withErrors(['Resident Tidak Ditemukan!']);
        }

        if($resident->foto){
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            Storage::delete('foto/' .$tahun. '/resident/' .$resident->foto);
        }
        
        $resident->delete();
        
        return redirect(route('divman.resident'))->with(['sukses' => "Resident Telah Dihapus!"]);
    }

    public function import()
    {
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        
        if($this->helper->isMobile())
            return view('m.divman.resident.import', [
                'tahun' => $tahun,
                'data' => false,
                'kosong' => ''
                ]);
    
        return view('divman.resident.import', [
            'tahun' => $tahun,
            'data' => false,
            'kosong' => ''
            ]);
    }

    public function verifyImport(Request $request)
    {
        $this->validate($request, [
            'file' => "required|mimes:xlsx"
        ]);
        
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());

        $nama_file_baru = 'data.xlsx';
            
        // Cek apakah terdapat file data.xlsx pada folder tmp
        if(is_file('storage/import/temp/'.$nama_file_baru)) // Jika file tersebut ada
            Storage::delete('storage/import/temp/'.$nama_file_baru); // Hapus file tersebut
        
        $file = $request->file('file');
        
        // Upload file yang dipilih ke folder tmp
        $file->move('storage/import/temp/', $nama_file_baru);
                            
        $excelreader = new Xlsx();
        $loadexcel = $excelreader->load('storage/import/temp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

        $datas = array();
        $numrow = 1;
        $kosong = 0;
        foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
            $data = array();
            // Ambil data pada excel sesuai Kolom
            $nomor = $row['A']; // Ambil data Nomor Kamar
            $nama = $row['B']; // Ambil data Nama
            $nim = $row['C']; // Ambil data NIM
            
            // Cek jika semua data tidak diisi
            if(empty($nomor) && empty($nama) && empty($nim))
                continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
            
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            if($numrow > 1){
                // Jika salah satu data ada yang kosong
                if(empty($nomor) or empty($nama) or empty($nim)){
                    $kosong++; // Tambah 1 variabel $kosong
                }

                $kamar = Kamar::where('idtahun', $this->helper->idTahunAktif())
                        ->where('jeniskelamin', Auth::user()->jeniskelamin)
                        ->with('resident')
                        ->with('senior')
                        ->where('nomor', $nomor)->first();
                        
                if($kamar==NULL || $kamar->senior!=NULL || $kamar->resident!=NULL) {
                    $kosong++; // Kosong +1 bila nomor kamar tidak sesuai dengan ID Usrohnya
                    $kamar=NULL;
                }
                    
                $data['idkamar'] = $kamar!=NULL ? $kamar->id : NULL;
                $data['nomor'] = $kamar!=NULL ? $kamar->nomor : NULL;
                $data['idusroh'] = $kamar!=NULL ? $kamar->usroh->id : NULL;
                $data['usroh'] = $kamar!=NULL ? $kamar->usroh->nama : NULL;
                $data['nama'] = $nama;
                $data['nim'] = $nim;
                array_push($datas, $data);
            }
            $numrow++; // Tambah 1 setiap kali looping
        }

        Cache::put('residentimport', $datas, now()->addHour());

        session()->flash('sukses', 'Pastikan Data Sudah Benar');

        if($this->helper->isMobile())
            return view('m.divman.resident.import', 
            [
                'tahun' => $tahun,
                'kosong' => $kosong,
                'data' => $datas
            ]);
    
        return view('divman.resident.import', 
        [
            'tahun' => $tahun,
            'kosong' => $kosong,
            'data' => $datas
        ]);
    }
    
    public function prosesImport(Request $request)
    {
        $isfail = false;
        $data = Cache::get('residentimport', false);
        if(!$data) {
            return redirect('divman.resident.import');
        }

        DB::beginTransaction();
        try {
            foreach ($data as $value) {
                Resident::create([
                    'idusroh' => $value['idusroh'],
                    'idkamar' => $value['idkamar'],
                    'idtahun' => $this->helper->idTahunAktif(),
                    'nama' => $value['nama'],
                    'nim' => $value['nim'],
                    'jeniskelamin' => Auth::user()->jeniskelamin
                ]);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $isfail = true;
        }

        if($isfail)
            return redirect(route('divman.resident.import'))->withErrors(['Proses Import Gagal!']);

        return redirect(route('divman.resident'))->with(['sukses' => 'Data Resident Berhasil Diimport!']);
    }

    public function getKamar($idusroh)
    {
        
        $kamar = Kamar::where('idtahun', $this->helper->idTahunAktif())
                ->where('jeniskelamin', Auth::user()->jeniskelamin)
                ->where('idusroh', $idusroh)
                ->doesntHave('resident')->doesntHave('senior')
                ->get();
                
        if(count($kamar)===0)
            $kamar = 0;
        return $kamar;
    }
}
