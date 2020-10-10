<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Senior;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

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
        $tahun = Str ::replaceFirst('/', '-', $this->helper->tahunAktif());
        
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
            'max' => Str::upper(':attribute').' Tidak boleh lebih dari 2mb',
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
        if($request->hasFile('foto')){
            $this->validate($request, ['foto' => 'mimes:jpeg,jpg,png|max:2048',], $message);
            $file = $request->file('foto');
            $name = $senior->id .".jpg";
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());

            $img = Image::make($file)->encode('jpg');
            $quality = 0;
            $imgsize = $file->getSize();
            if($imgsize<500000) {
                $quality = 60;
            } else if($imgsize>500000 && $imgsize<1000000) {
                $quality = 40;
            } else if($imgsize>1000000 && $imgsize<1500000) {
                $quality = 20;
            } else {
                $quality = 8;
            }
            $img->save('storage/foto/' .$tahun. "/senior/".$name, $quality);

            $senior->foto = $name;
        }

        $senior->nama = $request->nama;
        $senior->nim = $request->nim;
        $senior->save();
        
        return redirect()->back()->with(['sukses' => 'Profile Berhasil Diperbarui']);
    }
}
