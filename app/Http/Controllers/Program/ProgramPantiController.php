<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\ProgramPanti;
use App\Http\Requests\StoreProgramPantiRequest;
use App\Http\Requests\UpdateProgramPantiRequest;
use App\Models\FotoProgram;
use App\Models\JenisProgram;

class ProgramPantiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $program = ProgramPanti::with('jenis_program')->get();
        $jenis = JenisProgram::all();

        $data = [
            'program' => $program->toArray(),
            'jenis' => $jenis->toArray(),
        ];

        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgramPantiRequest $request)
    {
        // Menggunakan $request->validated() untuk mendapatkan data yang telah divalidasi
        $data = $request->validated();

        // Membuat program baru dengan data yang telah divalidasi
        $programPanti = ProgramPanti::create($data);

        // Mengambil file foto dari request dan menyimpannya
        $gambarPath = $request->file('gambar_thumbnail')->store('uploads/program-panti');

        return response()->json(['message' => 'Berhasil menambahkan program panti', 'data' => $programPanti], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProgramPanti $programPanti)
    {
        if(!$programPanti) {
            return response()->json(["message" => "data tidak ditemukan"], 404);
        }

        return response()->json($programPanti, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramPantiRequest $request, ProgramPanti $programPanti)
    {
        $data = $request->validated();

        // Mengupdate program dengan data yang telah divalidasi
        $programPanti->update($data);

        if ($request->hasFile('foto_programs')) {
            foreach ($request->file('foto_programs') as $file) {
                $path = $file->store('public/storage');
                $filename = basename($path);

                // Cek apakah program sudah memiliki foto
                if ($programPanti->fotoProgram) {
                    // Jika sudah, update informasi foto yang sudah ada
                    $programPanti->fotoProgram->update(['nama_foto' => $filename]);
                } else {
                    // Jika belum, tambahkan foto program baru
                    $fotoProgram = FotoProgram::create(['program_panti_id' => $data['id'],'nama_foto' => $filename]);
                }
            }
        }

        return response()->json(['message' => 'Berhasil memperbarui program panti', 'data' => $programPanti]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPanti $programPanti)
    {
        $programPanti->delete();

        return response()->json(["data" => $programPanti->judul,"message" => "Berhasil menghapus program panti"], 200);
    }
}
