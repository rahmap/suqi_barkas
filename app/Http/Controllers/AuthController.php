<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Kavist\RajaOngkir\RajaOngkir;

class AuthController extends Controller
{

    public function __construct()
    {
        $data = Kategori::with(['produks' => function ($q){
            $q->where('deleted_at', NULL);
        }])->limit(6)->inRandomOrder()->get();
        View::share('kategoriConstruct', $data);
    }

    public function index()
    {
        $RO = new RajaOngkir(getenv('RAJAONGKIR_API_KEY'));

        $data = [
            'title' => 'Auth',
            'provinsis' => $provinsi = $RO->provinsi()->all()
        ];
//        dd(Auth::user());
        return view('auth.v_auth', $data);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|digits_between:9,20|starts_with:62|unique:users,phone',
            'password' => 'required|min:6|max:30|confirmed',
            'location' => 'required|min:10|max:150|string',
            'provinsi' => 'required',
            'kabupaten' => 'required'
        ]);
        $insert = [
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower(trim($request->email)),
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'provinsi' => explode('_',$request->provinsi)[1],
            'kabupaten' => explode('_',$request->kabupaten)[1],
            'is_active' => 1,
            'location' => ucwords($request->location)
        ];

//        dd($insert);

        if(User::create($insert)){
            Session::flash('message',
                sweetAlert('Success','Berhasil membuat akun.', 'success'));
        } else {
            Session::flash('message',
                sweetAlert('Maaf','Gagal membuat akun.', 'error'));
        }
        return redirect()->route('auth');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_login' => 'required|email',
            'password_login' => 'required|min:6|max:30'
        ]);

        if(Auth::attempt([
            'email' => $request->email_login,
            'password' => $request->password_login
        ])){
//            dd(Auth::guard()->user());
            return redirect()->route('home')->with('message',
                sweetAlert('Success','Berhasil Login.','success'));
        } else {
            return redirect()->back()->with('message',
                sweetAlert('Gagal','Tidak dapat menemukan Akun.','error'));
       }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('auth')->with('message',
            sweetAlert('Terimakasih','Anda telah Keluar.','info'));
    }

    public function indexAdmin()
    {
        $data = [
            'title' => 'Auth Admin'
        ];
//        dd(Auth::guard('admin')->user());
        return view('auth.v_auth_admin', $data);
    }


    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email_login' => 'required|email',
            'password_login' => 'required|min:6|max:30'
        ]);

        if(Auth::guard('admin')->attempt([
            'email' => $request->email_login,
            'password' => $request->password_login
        ])){
//            dd(Auth::guard()->user());
            return redirect()->route('home')->with('message',
                sweetAlert('Success','Berhasil Login.','success'));
        } else {
            return redirect()->back()->with('message',
                sweetAlert('Gagal','Tidak dapat menemukan Akun.','error'));
        }
    }

    public function logoutAdmin() {
        Auth::guard('admin')->logout();
        return redirect()->route('home')->with('message',
            sweetAlert('Terimakasih','Anda telah Keluar.','info'));
    }

    public function getKabupatenByIdProv($idProv)
    {
        $RO = new RajaOngkir(getenv('RAJAONGKIR_API_KEY'));
        $provinsi = $RO->kota()->dariProvinsi($idProv)->get();
        return response([
            'results' => ($provinsi),
            'statusText' => 'Oke'
        ]);
    }
}
