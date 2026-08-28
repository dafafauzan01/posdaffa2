<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'name'           => 'required|string|max:255',
            'jenis_id'       => 'required|exists:jenis,id', // Cek keberadaan ID di tabel jenis
            'purchase_price' => 'required|integer|min:0',
            'selling_price'  => 'required|integer|min:0',
            'stock'          => 'required|integer|min:0',
        ];
    }

    /**
     * Custom message for validation errors.
     */
    public function messages(): array
    {
        return [
            'foto.image'             => 'File yang diunggah harus berupa gambar.',
            'foto.mimes'             => 'Ekstensi gambar harus JPG, JPEG, PNG, atau WEBP.',
            'foto.max'               => 'Maksimal ukuran gambar adalah 2MB.',
            
            'name.required'          => 'Nama produk wajib diisi.',
            'name.string'            => 'Nama produk harus berupa teks.',
            'name.max'               => 'Nama produk maksimal 255 karakter.',
            
            'jenis_id.required'      => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'        => 'Jenis produk yang dipilih tidak valid.',
            
            'purchase_price.required'=> 'Harga beli wajib diisi.',
            'purchase_price.integer' => 'Harga beli harus berupa angka bulat.',
            'purchase_price.min'     => 'Harga beli tidak boleh kurang dari 0.',
            
            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.integer'  => 'Harga jual harus berupa angka bulat.',
            'selling_price.min'      => 'Harga jual tidak boleh kurang dari 0.',
            
            'stock.required'         => 'Stok wajib diisi.',
            'stock.integer'          => 'Stok harus berupa angka.',
            'stock.min'              => 'Stok tidak boleh kurang dari 0.',
        ];
    }
}