<?php

namespace App\Http\Controllers;

use App\Models\Lpd;
use App\Http\Requests\Lpd\CreateLpdRequest;
use App\Http\Requests\Lpd\UpdateLpdRequest;
use Illuminate\Http\Request;

class LpdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lpd::all();
        return response()->json([
            'success' => true,
            'message' => 'Ini Index LPD',
            'data'    => $data
        ], 201);
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
    public function store(CreateLpdRequest $request)
    {
        $create_lpd = Lpd::create($request->validated());

        if($create_lpd){
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Buat LPD',
                'data'    => $create_lpd 
            ], 201);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Gagal Dalam Menyimpan data LPD',
            ], 409);
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lpd $lpd)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data LPD',
            'data'    => $lpd
        ], 200);
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
    public function update(UpdateLpdRequest $request, Lpd $lpd)
    {
        if($lpd){
            $lpd->update($request->validated());
            if($lpd){
                return response()->json([
                    'success' => true,
                    'message' => 'Sukses Update Data LPD',
                    'data'    => $lpd
                ], 200);
            }
            return response()->json([
                'success' => false,
                'message' => 'Gagal Update Data LPD',
            ], 409);
        }
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
