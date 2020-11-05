<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Senior;
use App\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $senior = Auth::user();
        $tahunsenior = Tahun::find($senior->idtahun);
        $tahun = Str::replaceFirst('/', '-', $tahunsenior->tahunajaran);
        
        if($this->helper->isMobile())
            return view('m.senior.profile.index', [
                'tahun' => $tahun,
                'profile' => $senior
                
            ]);
        
        return view('senior.profile.index', [
            'tahun' => $tahun,
            'profile' => $senior
            
        ]);
    }

    public function simpan(Request $request)
    {
        $message = [
            'required' => Str::upper(':attribute').' Harus Diisi',
            'unique' => Str::upper(':attribute').' Telah Digunakan',
            'digits' => Str::upper(':attribute').' Harus Berjumlah 11',
            'mimes' => Str::upper(':attribute').' Harus JPG, JPEG atau PNG',
            'max' => Str::upper(':attribute').' Tidak boleh lebih dari 1mb',
        ];

        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|unique:resident,nim|digits:11',
            'password' => 'required',
        ], $message);

        $senior = Senior::find(auth()->user()->id);

        // Verifiy Password
        if(!password_verify($request->password, $senior->password)) {
            return redirect()->bacK()->withErrors(['Password Salah']);
        }

        // Verifiy Ketika Ganti Password
        if($request->newpassword || $request->renewpassword) {
            if(Str::length($request->newpassword)<8) {
                return redirect()->bacK()->withErrors(['Password Baru Minimal 8 Karakter!']);
            } else {
                if($request->newpassword!==$request->renewpassword) {
                    return redirect()->bacK()->withErrors(['Password Baru Tidak Sama!']);
                } else {
                    $senior->password = Hash::make($request->newpassword);
                }
            }
        }
        
        // Verifiy Ketika Tambah/Ganti Passcode
        if($request->passcode || $request->repasscode) {
            if(Str::length($request->passcode)<6) {
                return redirect()->back()->withErrors(['Passcode Minimal 6 Angka!']);
            } else {
                if($request->passcode!==$request->repasscode) {
                    return redirect()->back()->withErrors(['Passcode Tidak Sama!']);
                } else {
                    if($request->passcode==="000000") {
                        $senior->passcode = null;
                        session()->flash('passcoderemove', true);
                    } else {
                        if(!(intval($request->passcode) && intval($request->repasscode))) {
                            return redirect()->back()->withErrors(['Passcode Harus Berupa Angka']);
                        }
                        $senior->passcode = $request->passcode;
                        session()->flash('passcode', $senior->username);
                    }
                }
            }
        }

        // Foto        
        if($request->foto){
            $name = $senior->id .".jpg";
            $tahunsenior = Tahun::find($senior->idtahun);
            $tahun = Str::replaceFirst('/', '-', $tahunsenior->tahunajaran);
            
            $img = explode(',', $request->foto);
            $image = base64_decode($img[1]);

            file_put_contents("foto/" .$tahun. "/senior/" .$name, $image);

            $senior->foto = $name;
        }

        $senior->nama = $request->nama;
        $senior->nim = $request->nim;
        $senior->save();
        
        return redirect()->back()->with(['sukses' => 'Profile Berhasil Diperbarui']);
    }
}
