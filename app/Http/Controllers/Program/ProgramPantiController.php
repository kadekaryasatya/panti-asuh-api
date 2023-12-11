<?php

namespace App\Http\Controllers\Program;

use App\Http\Controllers\Controller;
use App\Models\ProgramPanti;
use App\Http\Requests\StoreProgramPantiRequest;
use App\Http\Requests\UpdateProgramPantiRequest;
use Illuminate\Support\Facades\Storage;
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
        $data = $request->validated();

        // menyimpan foto ke lokal storage
        if ($request->hasFile('gambar_thumbnail')) {
            $publicPath = 'program-panti/';
            $path = $request->file('gambar_thumbnail')->store('uploads/program-panti');
            $data['gambar_thumbnail']->move($publicPath,$path);
            $filename = basename($path);
            $data['gambar_thumbnail'] = $filename;
        }

    $programPanti = ProgramPanti::create($data);


        return response()->json(['message' => 'Berhasil menambahkan program panti'], 201);
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
        // Validate the request data
        $data = $request->validated();

        // Check if a new image is provided in the request
        if ($request->hasFile('gambar_thumbnail')) {
            // Delete the previous image if it exists
            $this->deletePreviousImage($programPanti->gambar_thumbnail);

            // Store the new image
            $path = $request->file('gambar_thumbnail')->store('uploads/program-panti');
            $filename = basename($path);
            $data['gambar_thumbnail'] = $filename;
        }

        // Update the program with the validated data
        $programPanti->update($data);

        return response()->json(['message' => 'Berhasil memperbarui program panti'], 200);
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
            Storage::delete('uploads/program-panti/' . $filename);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramPanti $programPanti)
    {
        $programPanti->delete();

        return response()->json(["message" => "Berhasil menghapus program panti"], 200);
    }
}
