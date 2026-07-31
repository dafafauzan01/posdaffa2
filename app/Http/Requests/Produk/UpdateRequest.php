<?php

namespace App\Http\Requests\Produk;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'name' => 'required|string|max:255',
        'jenis' => 'required|in:Makanan,Minuman,Lainnya',
        'purchase_price' => 'required|integer|min:0',
        'selling_price' => 'required|integer|min:0',
        'stock' => 'required|integer|min:0',
    ];
}

public function messages(): array
{
    return [
        'foto.image' => 'File yang diupload harus gambar.',
        'foto.mimes' => 'Extensi gambar harus JPG, JPEG, PNG.',
        'foto.max' => 'Maksimal ukuran gambar 2MB.',
        'name.required' => 'Nama Wajib diisi.',
        'jenis.required' => 'Jenis produk wajib dipilih.',
        'jenis.in' => 'Jenis produk harus salah satu dari: Makanan, Minuman, Lainnya.',
        'email.email' => 'Format email tidak valid.',
        'purchase_price.required' => 'purchase price wajib diisi.',
        'purchase_price.integer' => 'purchase price harus diisi bilangan bulat.',
        'selling_price.required' => 'selling price wajib diisi.',
        'selling_price.integer' => 'selling price harus diisi bilangan bulat.',
        'stock.required' => 'Stock wajib diisi.',
        'stock.integer' => 'Stock harus diisi angka.',
    ];
}

}