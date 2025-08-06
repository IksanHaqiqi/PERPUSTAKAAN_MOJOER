<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lemari;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LemariApiController extends Controller
{
 
   public function index()
{
    return response()->json([
        'status' => true,
        'data' => Lemari::with('peminjamans')->get(),
    ]);
}


public function show($id)
{
    $lemari = Lemari::with('peminjamans')->find($id);

    if (!$lemari) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    return response()->json(['data' => $lemari]);
}


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $lemari = Lemari::create($data);

        return response()->json(['message' => 'Data berhasil ditambahkan', 'data' => $lemari]);
    }


    public function update(Request $request, $id)
    {
        $lemari = Lemari::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();

        if ($request->hasFile('image')) {
            if ($lemari->image) {
                Storage::disk('public')->delete($lemari->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $lemari->update($data);

        return response()->json(['message' => 'Data berhasil diperbarui', 'data' => $lemari]);
    }

    public function destroy($id)
    {
        $lemari = Lemari::find($id);

        if (!$lemari) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        if ($lemari->image) {
            Storage::disk('public')->delete($lemari->image);
        }

        $lemari->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
