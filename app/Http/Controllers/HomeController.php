<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Product;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{

    private $itemPerHalaman = 12;

    public function __construct()
    {
        $data = Kategori::with(['produks' => function ($q){
                $q->where('deleted_at', NULL);
            }])
            ->where('is_active',1)
            ->limit(6)->inRandomOrder()->get();
        View::share('kategoriConstruct', $data);
    }

    public function index()
    {
        $data = [
            'title' => 'Welcome',
            'produks' => Product::with(['kategoris','users'])
                ->where('kategori_id','!=',NULL)
                ->where('is_active',1)
                ->where('deleted_at', NULL)->paginate($this->itemPerHalaman),
            'kategoris' => Kategori::with(['produks' => function ($q){
                $q->where('deleted_at', NULL)->where('is_active', 1);
            }])->where('is_active',1)->get(),
            'relates' => Product::with(['kategoris'])->where('is_active',1)
                ->whereHas('kategoris', function ($q){
                    $q->where('slug', 'paketan')->orWhere('slug', 'paket')->where('is_active', 1);
                })
                ->where('kategori_id','!=',NULL)
                ->where('deleted_at', NULL)->limit(8)->inRandomOrder()->get(),
            'locationsProv' => \App\User::select('provinsi')->whereHas('products')->distinct()->get(),
            'locationsKab' => \App\User::select('kabupaten')->whereHas('products')->distinct()->get()
        ];
//        dd($data);
        return view('home.v_home_index', $data);
    }

    public function produk_page($slug){
        $produk = Product::with(['kategoris','users'])
            ->where('is_active',1)
            ->where('slug', $slug)->firstOrFail();
        $data = [
            'title' => 'Detail '.$produk['nama'],
            'produk' => $produk,
            'relates' => Product::with(['kategoris'])
                ->where('is_active',1)
                ->where('kategori_id','!=',NULL)
                ->where('id', '!=', $produk['id'])
                ->where('deleted_at', NULL)->limit(8)->inRandomOrder()->get()
        ];
//        dd($data);
        return view('home.v_home_single_page', $data);
    }


    public function filter(Request $request)
    {
//        dd($request->all());
        $kategori = $request->kategori;
        $produk = Product::with(['kategoris','users'])
        ->whereHas('kategoris', function($q) use($request){
            $q->where('is_active', 1);
            if($request->kategori != '' AND $request->kategori != 'all') $q->where('slug', $request->kategori);
        })
        ->whereHas('users', function ($q) use($request){
            $q->where('is_active', 1);
            if($request->kategori != '' AND $request->provinsi != 'all') $q->where('provinsi', 'like', '%'.str_replace('-', ' ', $request->provinsi).'%');
            if($request->kategori != '' AND $request->kabupaten != 'all') $q->where('kabupaten', 'Like', '%'.str_replace('-', ' ', $request->kabupaten).'%');
        })
        ->where('kategori_id','!=',NULL)
        ->where('is_active',1)
        ->where('deleted_at', NULL)->paginate($this->itemPerHalaman);
//        dd($produk->get());
        $data = [
            'title' => $produk[0]['kategoris']['nama'],
            'produks' => $produk,
            'kategoris' => Kategori::with(['produks' => function ($q){
                $q->where('deleted_at', NULL)->where('is_active',1);
            }])->where('is_active',1)->get(),
            'locationsProv' => \App\User::select('provinsi')->whereHas('products')->distinct()->get(),
            'locationsKab' => \App\User::select('kabupaten')->whereHas('products')->distinct()->get()
        ];
//        dd($data);

        return view('home.v_home_index_filter', $data);
    }

    public function search(Request $request)
    {
        $nama = $request->nama;
        $produk = Product::with(['kategoris','users'])
            ->whereHas('kategoris', function($q) use($request){
                $q->where('is_active', 1);
            })
            ->whereHas('users', function ($q) use($request){
                $q->where('is_active', 1);
            })
            ->where('kategori_id','!=',NULL)
            ->where('nama','like','%'.$nama.'%')
            ->where('is_active',1)
            ->where('deleted_at', NULL)->paginate($this->itemPerHalaman);

        $data = [
            'title' => $nama,
            'produks' => $produk,
            'kategoris' => Kategori::with(['produks' => function ($q){
                $q->where('deleted_at', NULL)->where('is_active',1);
            }])->where('is_active',1)->get(),
            'locationsProv' => \App\User::select('provinsi')->whereHas('products')->distinct()->get(),
            'locationsKab' => \App\User::select('kabupaten')->whereHas('products')->distinct()->get()
        ];

        return view('home.v_home_index_filter', $data);
    }
    
    public function penjualPage($slug)
    {
        $id = explode('-',$slug)[0];
        $user = \App\User::with('products.kategoris')->findOrFail($id);
        $produks = \App\Product::with('kategoris')
            ->where('user_id', $id);
        $data = [
            'pageNama' => 'penjual',
            'user' => $user,
            'produks' => $produks->paginate($this->itemPerHalaman),
            'title' => 'Penjual '.$user['nama'],
            'kategoris' => Kategori::with(['produks' => function ($q) use($id){
                $q->where('deleted_at', NULL)
                ->where('user_id', $id)
                ->where('is_active',1);
            }])->where('is_active',1)->get()
        ];
        
//        dd($data);
        
        
        return view('home.v_home_penjual', $data);
    }

    public function tentang()
    {
        $data = [
            'title' => 'Tentang'
        ];

        return view('home.v_home_about', $data);
    }

    public function kontak()
    {
        $data = [
            'title' => 'Kontak'
        ];

        return view('home.v_home_contact', $data);
    }

    public function faq()
    {
        $data = [
            'title' => 'Syarat & Ketentuan'
        ];

        return view('home.v_home_faq', $data);
    }
}
