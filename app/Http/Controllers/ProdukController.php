<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Produk',
            'produks' => Product::with('kategoris')->where('deleted_at', NULL)->get()
        ];
//        dd($data);
        return view('customer.produk.v_customer_produk_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambahkan Product',
            'kategoris' => Kategori::all()
        ];

        return view('customer.produk.v_customer_produk_add', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar_tambahan' => 'mimes:jpeg,bmp,png,jpg',
            'gambar' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        $req = \request()->all();
        $request->gambar->store('product', 'public');
        $request->gambar_tambahan->store('product', 'public');
        $req['gambar'] = $request->gambar->hashName();;
        $req['slug'] = Str::slug($request->nama).'-'.Str::random(4);
        $req['gambar_tambahan'] = $request->gambar_tambahan->hashName();
        Product::create($req);
        return redirect()->route('produk.create')
            ->with('message',
                sweetAlert('Success', 'Berhasil menambahkan Product.','success'));
    }


    public function show(Product $produk)
    {
//        dd(File::get(public_path('storage/product/'.$produk->gambar)));
        $data = [
            'title' => 'Detail Product',
            'produk' => $produk
        ];

        return view('customer.produk.v_customer_produk_detail', $data);
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Update Product',
            'kategoris' => Kategori::all(),
            'produk' => Product::findOrFail($id)
        ];

        return view('customer.produk.v_customer_produk_edit', $data);
    }


    public function update(Product $produk, Request $request)
    {
        $req = $request->all();
        if ($request->hasFile('gambar')) {

            $request->validate([
                'gambar' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            $request->gambar->store('product', 'public');
            $req['gambar'] = $request->gambar->hashName();
            try {
                if(Storage::disk('local')->exists('public/product/'.$produk->gambar)){
                    Storage::disk('local')->delete('public/product/'.$produk->gambar);
                }
            } catch (\Exception $exception) {
                dd($exception);
            }

        } else {
            $req['gambar'] = $produk->gambar;
        }

        if ($request->hasFile('gambar_tambahan')) {

            $request->validate([
                'gambar_tambahan' => 'mimes:jpeg,bmp,png,jpg'
            ]);
            $request->gambar_tambahan->store('product', 'public');
            $req['gambar_tambahan'] = $request->gambar_tambahan->hashName();
            if(Storage::disk('local')->exists('public/product/'.$produk->gambar_tambahan)){
                Storage::disk('local')->delete('public/product/'.$produk->gambar_tambahan);
            }
        } else {
            $req['gambar_tambahan'] = $produk->gambar_tambahan;
        }
        if($req['nama'] != $produk->nama){
            $req['slug'] = Str::slug($request->nama).'-'.Str::random(4);
        }
        $req['nama'] = ucwords(strtolower($request->nama));
        $produk->fill($req)->save();
        return redirect()->route('produk.edit', ['produk' => $produk->id])
            ->with('message',
                sweetAlert('Success', 'Berhasil mengupdate Product.','success'));
    }

    public function destroy(Product $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')
            ->with('message',
                sweetAlert('Success', 'Berhasil menghapus Product.','success'));
    }
}
