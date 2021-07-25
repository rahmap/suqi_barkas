<?php

namespace App\Http\Controllers;

use App\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'List Kategori',
            'kategoris' => Kategori::all()
        ];

        return view('admin.kategori.v_admin_kategori_list', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kategori'
        ];

        return view('admin.kategori.v_admin_kategori_add', $data);
    }

    public function store(Request $request)
    {
       $request->validate([
          'nama' => 'required|string|min:3|max:20|unique:kategoris,nama'
       ]);
       $nama = ucwords($request->nama);
       $slug = Str::slug(strtolower($nama));
       if(Kategori::create(['nama' => $nama, 'slug' => $slug, 'is_active' => 1])){
           return redirect()->route('kategori.create')
               ->with('message',
                   sweetAlert('Success', 'Berhasil menambahkan Kategori.','success'));
       } else {
           return redirect()->route('kategori.create')
               ->with('message',
                   sweetAlert('Maaf', 'Gagal menambahkan Kategori.','error'));
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Update Kategori',
            'kategori' => Kategori::findOrFail($id)
        ];

        return view('admin.kategori.v_admin_kategori_edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|min:3|max:20|unique:kategoris,nama'
        ]);
        $nama = ucwords($request->nama);
        $slug = Str::slug(strtolower($nama));

        $kategori = Kategori::findOrFail($id);
        $kategori->update(['nama' => $nama,'slug' => $slug, 'is_active' => $request->is_active]);
        return redirect()->route('kategori.index')
            ->with('message',
                sweetAlert('Success', 'Berhasil mengupdate Kategori.','success'));
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')
            ->with('message',
                sweetAlert('Success', 'Berhasil menghapus Kategori.','success'));
    }
}
