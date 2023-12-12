<?php

namespace App\Http\Controllers\Donasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Facades\Validator;



class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Donasi::all();

        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required',
            'nominal' => 'required',
            'pesan' => 'required',
            'bukti_bayar' => 'required',
            'donatur' => 'required',

        ], [
            'nama.required' => 'Data wajib diisi',
            'email.required' => 'Data wajib diisi',
            'nominal.required' => 'Data wajib diisi',
            'pesan.required' => 'Data wajib diisi',
            'bukti_bayar.required' => 'Data wajib diisi',
            'donatur.required' => 'Data wajib diisi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 400);
        } else {
            $gambarBukti = $request->file('bukti_bayar');
            $pathBukti = 'bukti-bayar/';
            $gambar_fileBukti = $gambarBukti->getClientOriginalName();
            $gambarBukti->move($pathBukti,$gambar_fileBukti);

            $data = [
                'nama' => $request->nama,
                'email' => $request->email,
                'nominal' => $request->nominal,
                'pesan' => $request->pesan,
                'bukti_bayar' => $gambar_fileBukti,
                'donatur' => $request->donatur,
                'isValid' => 'pending',
            ];

            Donasi::create($data);

            return response()->json(['success' => "Berhasil menyimpan data"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Donasi::find($id);
        if (!$data) {
            return response()->json(['errors' => ['Data tidak ditemukan']]);
        }
        else {
            return response()->json($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validasi = Validator::make($request->all(), [
            'isValid' => 'required',

        ], [
            'isValid.required' => 'Data wajib diisi',
        ]);
        if ($validasi->fails()) {
            return response()->json(['errors' => $validasi->errors()], 400);
        }

        $data = Donasi::find($id);

        if (!$data) {
            return response()->json(['errors' => ['Data tidak ditemukan']]);
        }

        $data->isValid = $request->isValid;

        $data->save();

        return response()->json(['success' => "Berhasil memperbarui data"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Donasi::find($id)->delete();
        return response()->json(['success'=>'Data berhasil Dihapus']);
    }
}
