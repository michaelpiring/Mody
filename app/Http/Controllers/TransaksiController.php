<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Nasabah;
use App\Models\Dompet;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\Transaksi\CreateTransaksiRequest;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Transaksi::all();
        if($data){
            return response()->json([
                'success' => true,
                'message' => 'Ini Index Data Transaksi',
                'data'    => $data
            ], 201);
        }
        return response()->json([
            'success' => false,
            'message' => 'Data tidak ditemukan',
        ], 404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTransaksiRequest $request)
    {
        $data = $request->validated();
        if(!$data){
            return response()->json([
                'success' => false,
                'message' => 'Gagal melakukan transaksi. Ada data yang tidak valid!'
            ], 400);
        }
        else{
            $data_pengirim = Nasabah::where('id_nasabah',$data['id_nasabah_pengirim'])->first();
            $data_penerima  = Nasabah::where('id_nasabah',$data['id_nasabah_penerima'])->first();

            $dompet_nasabah_pengirim = Dompet::where('id_dompet', $data_pengirim['id_dompet'])->first();
            $dompet_nasabah_penerima = Dompet::where('id_dompet', $data_penerima['id_dompet'])->first();

            if(Hash::check($data['password_nasabah'], $data_pengirim['password_nasabah'])){
                if($dompet_nasabah_pengirim['saldo_dompet']<=$data['jumlah_transaksi']){
                    return response()->json([
                        'success' => false,
                        'message' => 'Transaksi Gagal. Saldo tidak cukup!'
                    ], 400);
                }
                else{
                    $create_transaksi = Transaksi::create([
                        'id_nasabah_pengirim' => $data['id_nasabah_pengirim'],
                        'id_nasabah_penerima' => $data['id_nasabah_penerima'],
                        'tanggal_transaksi' => now(),
                        'jumlah_transaksi' => $data['jumlah_transaksi']
                    ]);
                    if($create_transaksi){
                        $create_detail = DetailTransaksi::create([
                            'id_transaksi' => $create_transaksi['id_transaksi'],
                            'id_nasabah_pengirim' => $data['id_nasabah_pengirim'],
                            'id_nasabah_penerima' => $data['id_nasabah_penerima'],
                            'keterangan' => $data['keterangan'],
                            'jumlah_transaksi' => $data['jumlah_transaksi'],
                            'tanggal_transaksi' => now()
                        ]);
                        if($create_detail){
                            $dompet_nasabah_pengirim['saldo_dompet'] = $dompet_nasabah_pengirim['saldo_dompet']-$data['jumlah_transaksi'];
                            $dompet_nasabah_penerima['saldo_dompet']  = $dompet_nasabah_penerima['saldo_dompet']+$data['jumlah_transaksi'];

                            $result_nasabah_pengirim = $dompet_nasabah_pengirim->update([
                                'saldo_dompet'  => $dompet_nasabah_pengirim['saldo_dompet']
                            ]);

                            $result_nasabah_penerima = $dompet_nasabah_penerima->update([
                                'saldo_dompet'  => $dompet_nasabah_penerima['saldo_dompet']
                            ]);

                            return response()->json([
                                'success' => true,
                                'message' => 'Transaksi Berhasil!',
                                'data'    => $create_detail
                            ], 201);
                        }
                    }
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal melakukan transaksi. Password Salah',
                ], 400);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DetailTransaksi $detailtransaksi)
    {
        if($detailtransaksi){
            return response()->json([
                'success' => true,
                'message' => 'Detail Data Transaksi',
                'data'    => $detailtransaksi
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal menampilkan data Transaksi',
            ], 409);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
