<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\FotoProgram;
use App\Http\Requests\StoreFotoProgramRequest;
use App\Http\Requests\UpdateFotoProgramRequest;
use Illuminate\Support\Facades\Storage;

class FotoProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fotoPrograms = FotoProgram::all();

        if($fotoPrograms->isEmpty()) {
            return response()->json(["message" => "data tidak ditemukan"], 200);
        }

        return response()->json($fotoPrograms, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFotoProgramRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('nama_foto')) {
            $path = $request->file('nama_foto')->store('public/storage');
            $filename = basename($path);
            $data['nama_foto'] = $filename;
        }

        $fotoProgram = FotoProgram::create($data);

        return response()->json(["data" => $fotoProgram, "message" => "Berhasil menambah foto program"], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(FotoProgram $fotoProgram)
    {
        if(!$fotoProgram) {
            return response()->json(["message" => "data tidak ditemukan"], 404);
        }

        return response()->json($fotoProgram, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFotoProgramRequest $request, FotoProgram $fotoProgram)
    {
        $data = $request->validated();

        if ($request->hasFile('nama_foto')) {
            // Delete the previous image if it exists
            $this->deletePreviousImage($fotoProgram->nama_foto);

            // Store the new image
            $path = $request->file('nama_foto')->store('public/storage');
            $filename = basename($path);
            $data['nama_foto'] = $filename;
        }

        $fotoProgram->update($data);

        return response()->json(["data" => $fotoProgram, "message" => "Berhasil memperbarui foto program"], 200);
    }

    /**
     * Delete the previous image associated with the ProgramPanti.
     *
     * @param string $filename
     * @return void
     */
    private function deletePreviousImage($filename)
    {
        // Check if the filename is not null
        if ($filename) {
            // Delete the previous image from storage
            Storage::delete('public/storage/' . $filename);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FotoProgram $fotoProgram)
    {
        $fotoProgram->delete();

        return response()->json(["data" => $fotoProgram->id,"message" => "Berhasil menghapus foto program"], 200);
    }
}
