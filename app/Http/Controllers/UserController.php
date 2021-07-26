<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function index()
    {
        $data = [
          'users' => User::all(),
          'title' => 'List Pelanggan'
        ];

        return view('admin.pelanggan.v_admin_pelanggan_list', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit(User $user)
    {
        $data = [
          'title' => 'Update Pelanggan',
          'user' => $user
        ];

        return view('admin.pelanggan.v_admin_pelanggan_edit', $data);
    }

    public function update(User $user, Request $request)
    {
        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required|digits_between:9,20|starts_with:62,08|unique:users,phone,'.$user->id,
            'password' => 'nullable|min:6|max:30|confirmed'
        ]);
        if(isset($request->password) AND !empty($request->password)){
            $updatePassword = Hash::make($request->password);
        } else {
            $updatePassword = $user->password;
        }
        $update = [
            'nama' => ucwords(strtolower($request->nama)),
            'email' => strtolower(trim($request->email)),
            'phone' => $request->phone,
            'password' => $updatePassword
        ];

        if($user->fill($update)->saveOrFail()){
            Session::flash('message',
                sweetAlert('Success','Berhasil mengupdate Akun Pelanggan.', 'success'));
        } else {
            Session::flash('message',
                sweetAlert('Maaf','Gagal mengupdate Akun Pelanggan.', 'error'));
        }
        return redirect()->route('user.edit', ['user' => $user->id]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')
            ->with('message',
                sweetAlert('Success', 'Berhasil menghapus Pelanggan.','success'));
    }
}
