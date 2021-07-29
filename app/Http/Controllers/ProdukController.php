<?php

namespace App\Http\Controllers;

use App\Kategori;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'List Produk',
            'produks' => Product::with('kategoris')->get()
        ];
//        dd($data);
        return view('customer.produk.v_customer_produk_list', $data);
    }

    public function listProductAdmin()
    {
        $data = [
            'title' => 'List Produk',
            'produks' => Product::with(['kategoris','users'])->withTrashed()->get()
        ];

        return view('admin.produk.v_admin_produk_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambahkan Product',
            'kategoris' => Kategori::where('is_active', 1)->get()
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
        $req['gambar'] = $request->gambar->hashName();
        $req['nama'] = ucwords($req['nama']);
        $req['slug'] = Str::slug($request->nama).'-'.Str::random(4);
        $req['gambar_tambahan'] = $request->gambar_tambahan->hashName();
        $req['user_id'] = Auth::guard('customer')->user()->id;
        Product::create($req);
        return redirect()->route('produk.create')
            ->with('message',
                sweetAlert('Success', 'Berhasil menambahkan Produk.','success'));
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

    public function showAdmin($produk)
    {
        $data = [
            'title' => 'Detail Product',
            'produk' => Product::with('kategoris','users')->withTrashed()->findOrFail($produk)
        ];

        return view('admin.produk.v_admin_produk_detail', $data);
    }


    public function edit($id)
    {
        $data = [
            'title' => 'Update Product',
            'kategoris' => Kategori::where('is_active', 1)->get(),
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
                sweetAlert('Success', 'Berhasil mengupdate Produk.','success'));
    }

    public function destroy(Product $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')
            ->with('message',
                sweetAlert('Success', 'Berhasil menghapus Produk.','success'));
    }

    public function aktifNonaktifCustomer(Product $product, $status)
    {
        $product->is_active = $status;
        $product->save();
        return redirect()->back()
            ->with('message',
                sweetAlert('Success', 'Berhasil mengupdate Status Produk.','success'));
    }

    public function aktifNonaktifAdmin($product, $status)
    {
        $pro = Product::findOrFail($product);
        $pro->is_active = $status;
        $pro->admin_id = Auth::guard('admin')->user()->id;
        $pro->save();
        return redirect()->back()
            ->with('message',
                sweetAlert('Success', 'Berhasil mengupdate Status Produk.','success'));
    }

    public function destroyAdmin($produk)
    {
        $update = Product::findOrFail($produk);
        $update->admin_id = Auth::guard('admin')->user()->id;
        $update->save();
        
        $pro = Product::findOrFail($produk);
        $pro->delete();
        return redirect()->back()
            ->with('message',
                sweetAlert('Success', 'Berhasil menghapus Produk.','success'));
    }
}
