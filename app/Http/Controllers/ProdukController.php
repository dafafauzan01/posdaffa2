<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        // Mengambil data produk beserta relasi jenis agar nama jenis langsung muncul
        $products = Produk::with('jenis')
            ->when($keyword, function ($query, $keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenis = Jenis::all();

        return view('produk.create', compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);
        $dataReq = $request->validated();

        $hargaBeli = (int) ($dataReq['purchase_price'] ?? $dataReq['harga_beli'] ?? 0);
        $hargaJual = isset($dataReq['selling_price']) && $dataReq['selling_price'] !== ''
            ? (int) $dataReq['selling_price']
            : (int) round($hargaBeli * 1.3);

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $dataReq['jenis_id'] ?? $dataReq['jenis'] ?? null,
            'nama'       => $dataReq['name'] ?? $dataReq['nama'] ?? null,
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
            'stok'       => $dataReq['stock'] ?? $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        $produk->load('jenis');

        return view('produk.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenis = Jenis::all();

        return view('produk.edit', compact('produk', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);
        $dataReq = $request->validated();

        $hargaBeli = (int) ($dataReq['purchase_price'] ?? $dataReq['harga_beli'] ?? 0);
        $hargaJual = isset($dataReq['selling_price']) && $dataReq['selling_price'] !== ''
            ? (int) $dataReq['selling_price']
            : (int) round($hargaBeli * 1.3);

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $dataReq['jenis_id'] ?? $dataReq['jenis'] ?? null,
            'nama'       => $dataReq['name'] ?? $dataReq['nama'] ?? null,
            'harga_beli' => $hargaBeli,
            'harga_jual' => $hargaJual,
            'stok'       => $dataReq['stock'] ?? $dataReq['stok'] ?? 0,
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}