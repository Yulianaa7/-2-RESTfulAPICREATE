<?php

namespace App\Http\Controllers;
use App\Detail_Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB; //agar bisa menggunakan query

class Detail_TransaksiController extends Controller
{
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'id_transaksi' => 'required',
                'id_produk' => 'required',
                'qty' => 'required',
            ]
        );
        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $id_produk = $request->id_produk;
        $qty = $request->qty;
        $harga = DB::table('produk')->where('id_produk', $id_produk)->value('harga');
        $subtotal= $harga * $qty;

        $simpan = Detail_Transaksi::create([
        'id_transaksi' => $request->id_transaksi,
        'id_produk' => $id_produk,
        'qty' => $qty,
        'subtotal' => $subtotal
        ]);

        if($simpan)
        {
            return Response()->json(['status' => 1]);
        }
        else
        {
            return Response()->json(['status' => 0]);
        }
    }
}