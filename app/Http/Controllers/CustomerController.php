<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Kavist\RajaOngkir\RajaOngkir;

class CustomerController extends Controller
{
    public function index()
    {
        $data = [
          'title' => 'Dashboard Pelanggan'
        ];

        return view('customer.v_customer_index', $data);
    }

    public function updateProfile()
    {
        $RO = new RajaOngkir(getenv('RAJAONGKIR_API_KEY'));
        $data = [
            'title' => 'Update Profile',
            'provinsis' => $RO->provinsi()->all(),
            'user' => Auth::guard('customer')->user()
        ];

        return view('customer.profile.v_customer_profile_edit', $data);
    }

    public function updateProfilePost(Request $request)
    {

        $customer = User::findOrFail(Auth::guard('customer')->user()->id);

        $request->validate([
            'nama' => 'required|string|min:5|max:20',
            'email' => 'required|email|unique:users,email,'.$customer['id'],
            'phone' => 'required|digits_between:9,20|starts_with:62|unique:users,phone,'.$customer['id'],
            'password' => 'nullable|min:6|max:30|confirmed',
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
            'location' => ucwords($request->location)
        ];
        if($customer->fill($insert)->save()){
            Session::flash('message',
                sweetAlert('Success','Berhasil memperbaruhi Profile.', 'success'));
        } else {
            Session::flash('message',
                sweetAlert('Maaf','Gagal memperbaruhi Profile.', 'error'));
        }

        return redirect()->back();
    }

//    public function list()
//    {
//        $data = [
//            'title' => 'List Pesanan',
//            'orders' => Order::where('user_id', Auth::guard('customer')->user()->id)->get()->toArray()
//        ];
//
//        return view('customer.pesanan.v_customer_pesanan_list', $data);
//    }
//
//    public function detail($orderId)
//    {
//        $data = [
//            'title' => 'Detail Pesanan',
//            'order' => Order::where('user_id', Auth::guard('customer')->user()->id)
//                ->with(['orderProduks','admins','users'])->findOrFail($orderId)
//        ];
////        dd($data);
//        return view('customer.pesanan.v_customer_pesanan_detail', $data);
//    }
//
//    public function detailPost(Request $request, $id)
//    {
//        $order = Order::where('user_id', Auth::guard('customer')->user()->id)
//            ->findOrFail($id);
//
//        if ($request->hasFile('bukti_pembayaran')) {
//
//            $request->validate([
//                'bukti_pembayaran' => 'mimes:jpeg,bmp,png,jpg'
//            ]);
//            $request->bukti_pembayaran->store('bukti', 'public');
//            $req['bukti_pembayaran'] = $request->bukti_pembayaran->hashName();
//            $req['informasi_pemesanan'] = 'Bukti Pembayaran sudah diupload customer, menunggu verifikasi.';
//            try {
//                if(Storage::disk('local')->exists('public/bukti/'.$order->bukti_pembayaran)){
//                    Storage::disk('local')->delete('public/bukti/'.$order->bukti_pembayaran);
//                }
//            } catch (\Exception $exception) {
//                dd($exception);
//            }
//
//        } else {
//            $req['bukti_pembayaran'] = $order->bukti_pembayaran;
//            $req['informasi_pemesanan'] = $order->informasi_pemesanan;
//        }
//
//        if($order->fill([
//            'bukti_pembayaran' => $req['bukti_pembayaran'],
//            'informasi_pemesanan' => $req['informasi_pemesanan']
//        ])->save()){
//            return redirect()->back()
//                ->with('message',
//                    sweetAlert('Success', 'Berhasil mengupdate Pesanan.','success'));
//        } else {
//            return redirect()->back()
//                ->with('message',
//                    sweetAlert('Maaf', 'Gagal mengupdate Pesanan.','error'));
//        }
//    }
//
//    public function hapusBuktiPembayaran($id)
//    {
//        $order = Order::where('user_id', Auth::guard('customer')->user()->id)
//            ->where('status_pemesanan','=','pending')
//            ->findOrFail($id);
//
//        $order->bukti_pembayaran = null;
//        $order->informasi_pemesanan = 'Menunggu Pembayaran.';
//        $order->save();
//        return redirect()->back()
//            ->with('message',
//                sweetAlert('Success', 'Berhasil menghapus Bukti Pembayaran Pesanan.','success'));
//    }
//
//    public function batalkanPesanan($id)
//    {
//        $order = Order::where('user_id', Auth::guard('customer')->user()->id)
//            ->where('status_pemesanan','=','pending')
//            ->findOrFail($id);
//        $order->status_pemesanan = 'cancel';
//        $order->informasi_pemesanan = 'Pesanan Dibatalkan oleh Pelanggan.';
//        $order->save();
//        return redirect()->back()
//            ->with('message',
//                sweetAlert('Success', 'Berhasil membatalkan pesanan.','success'));
//    }
}
