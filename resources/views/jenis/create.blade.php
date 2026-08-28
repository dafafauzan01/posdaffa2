@extends('layouts.app')

@section('title', 'Tambah Jenis Produk')

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            
            <!-- Header Page -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <a href="{{ route('jenis.index') }}" class="text-decoration-none text-muted small fw-semibold d-inline-flex align-items-center gap-1 mb-1">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Jenis
                    </a>
                    <h4 class="fw-bold m-0" style="color: #1f2937;">Tambah Jenis Produk</h4>
                </div>
            </div>

            <!-- Card Form -->
            <div class="card border-0 shadow-sm rounded-4 p-4" style="background: #ffffff;">
                <form action="{{ route('jenis.store') }}" method="POST">
                    @include('jenis._form')
                </form>
            </div>

        </div>
    </div>
</div>
@endsection