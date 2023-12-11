<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\JenisProgram;
use App\Http\Requests\StoreJenisProgramRequest;
use App\Http\Requests\UpdateJenisProgramRequest;

class JenisProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisProgram::all();

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreJenisProgramRequest $request)
    {
        $data = $request->validated();

        $jenisProgram = JenisProgram::create($data);

        return response()->json(["message" => "Berhasil membuat jenis program"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisProgram $jenisProgram)
    {
        if(!$jenisProgram) {
            return response()->json(["message" => "data tidak ditemukan"], 404);
        }

        return response()->json($jenisProgram, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisProgramRequest $request, JenisProgram $jenisProgram)
    {
        $data = $request->validated();

        $jenisProgram->update($data);

        return response()->json(["message" => "Berhasil memperbarui jenis program"], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisProgram $jenisProgram)
    {
        $jenisProgram->delete();

        return response()->json(["message" => "Berhasil menghapus jenis program"], 200);
    }
}
