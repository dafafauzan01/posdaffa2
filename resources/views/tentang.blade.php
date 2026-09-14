@extends('layouts.app')

@section('title', 'Tentang Perusahaan')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(135deg, #5b21b6 0%, #7c3aed 100%);">
        <div class="card-body p-4 text-white">
            <h3 class="fw-bold mb-1">PT Nexus Digital Nusantara</h3>
            <p class="mb-0 text-white-50">Solusi Teknologi Informasi & Modernisasi Bisnis</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Profil Perusahaan</h5>
                    <p class="text-secondary mb-3">
                        PT Nexus Digital Nusantara adalah perusahaan pengembang perangkat lunak yang berfokus pada penyediaan sistem manajemen digital terintegrasi untuk berbagai skala bisnis.
                    </p>
                    <p class="text-secondary mb-0">
                        Kami menghadirkan inovasi teknologi yang efisien, aman, dan dapat diandalkan untuk membantu otomatisasi operasional bisnis secara menyeluruh.
                    </p>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Visi & Misi</h5>
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1">Visi</h6>
                        <p class="text-secondary mb-0">Menjadi mitra teknologi tepercaya dalam mendorong transformasi digital industri di Indonesia.</p>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Misi</h6>
                        <ul class="text-secondary mb-0 ps-3">
                            <li>Mengembangkan sistem perangkat lunak yang modern dan mudah digunakan.</li>
                            <li>Memberikan layanan integrasi sistem dengan keamanan data tingkat tinggi.</li>
                            <li>Mendukung efisiensi operasional bagi UMKM hingga perusahaan berskala besar.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold text-primary mb-3">Informasi Kontak</h5>
                    <ul class="list-unstyled mb-0 text-secondary">
                        <li class="mb-2"><strong>Alamat:</strong> Jl. Raya Boulevard No. 88, Jakarta</li>
                        <li class="mb-2"><strong>Email:</strong> info@nexusdigital.co.id</li>
                        <li class="mb-2"><strong>Telepon:</strong> (021) 5555-8888</li>
                        <li><strong>Website:</strong> 
                <a href="https://nexusdigital.co.id" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-primary">
                    nexusdigital.co.id</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection