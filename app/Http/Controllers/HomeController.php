<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Product;
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
            'produks' => Product::with('kategoris')
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
                ->where('deleted_at', NULL)->limit(8)->inRandomOrder()->get()
        ];
//        dd($data);
        return view('home.v_home_index', $data);
    }

    public function produk_page($slug){
        $produk = Product::with('kategoris')
            ->where('is_active',1)
            ->where('slug', $slug)->firstOrFail();
        $data = [
            'title' => 'Detail '.$produk['nama'],
            'produk' => $produk,
            'relates' => Product::with('kategoris')
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
        $produk = Product::select(['produks.*','kategoris.nama as knama', 'kategoris.slug as kslug'])
            ->where('produks.is_active',1)
            ->where('produks.kategori_id', '!=', NULL)
            ->where('kategoris.slug','=',$kategori)
            ->join('kategoris','kategoris.id', '=', 'produks.kategori_id')
            ->where('produks.deleted_at', NULL)->paginate($this->itemPerHalaman);

        $data = [
            'title' => $produk[0]['kategoris']['nama'],
            'produks' => $produk,
            'kategoris' => Kategori::with(['produks' => function ($q){
                $q->where('deleted_at', NULL)->where('is_active',1);
            }])->where('is_active',1)->get()
        ];
//        dd($data);

        return view('home.v_home_index_filter', $data);
    }

    public function search(Request $request)
    {
        $nama = $request->nama;
        $produk = Product::select(['produks.*','kategoris.nama as knama', 'kategoris.slug as kslug'])
            ->where('is_active',1)
            ->where('produks.kategori_id', '!=', NULL)
            ->join('kategoris','kategoris.id', '=', 'produks.kategori_id')
            ->where('produks.nama','like', '%' . $nama . '%')
            ->where('produks.deleted_at', NULL)->paginate($this->itemPerHalaman);

        $data = [
            'title' => $nama,
            'produks' => $produk,
            'kategoris' => Kategori::with(['produks' => function ($q){
                $q->where('deleted_at', NULL)->where('is_active',1);
            }])->get()
        ];

        return view('home.v_home_index_filter', $data);
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
