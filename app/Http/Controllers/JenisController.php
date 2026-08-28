<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::latest()->paginate(10);
        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis',
        ], [
            'nama_jenis.required' => 'Nama jenis produk wajib diisi.',
            'nama_jenis.unique'   => 'Nama jenis produk ini sudah ada.',
        ]);

        Jenis::create([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil ditambahkan.');
    }

    public function edit(Jenis $jeni)
    {
        // Sesuaikan parameter jika binding route menggunakan $jenis
        $jenis = $jeni;
        return view('jenis.edit', compact('jenis'));
    }

    public function update(Request $request, Jenis $jeni)
    {
        $jenis = $jeni;
        
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis,nama_jenis,' . $jenis->id,
        ], [
            'nama_jenis.required' => 'Nama jenis produk wajib diisi.',
            'nama_jenis.unique'   => 'Nama jenis produk ini sudah ada.',
        ]);

        $jenis->update([
            'nama_jenis' => $request->nama_jenis,
        ]);

        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil diperbarui.');
    }

    public function destroy(Jenis $jeni)
    {
        $jeni->delete();
        return redirect()->route('jenis.index')->with('success', 'Jenis produk berhasil dihapus.');
    }
}