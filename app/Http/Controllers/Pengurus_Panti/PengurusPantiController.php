<?php

namespace App\Http\Controllers\Pengurus_Panti;

use App\Http\Controllers\Controller;
use App\Models\PengurusPanti;
use Illuminate\Http\Request;


class PengurusPantiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengurusPantis = PengurusPanti::all();
        return response()->json($pengurusPantis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengurusPanti = PengurusPanti::create($request->all());
        return response()->json('data berhasil ditambahkan', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengurusPanti = PengurusPanti::findOrFail($id);
        return response()->json($pengurusPanti);
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
        $pengurusPanti = PengurusPanti::findOrFail($id);

        $request->validate([
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'no_telepon' => 'required|string',
            'isActive' => 'required|in:aktif,non-aktif',
        ]);

        $pengurusPanti->update($request->all());

        return response()->json('data berhasil ditambahkan', 200);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pengurusPanti = PengurusPanti::findOrFail($id);
        $pengurusPanti->delete();
        return response()->json(['message' => 'Pengurus Panti deleted']);
    }
}
