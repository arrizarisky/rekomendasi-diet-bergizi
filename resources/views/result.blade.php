@extends('layouts.app')

@section('title', 'Hasil Diagnosis Nutrisi')

@section('content')
<div class="container mt-5 pt-4">
    <div class="text-center mb-4">
        <h1 class="display-4">📊 Hasil Diagnosis Nutrisi</h1>
        <p class="text-muted">Berikut adalah hasil berdasarkan data yang Anda masukkan.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">
                    Data Diri
                </div>
                <div class="card-body">
                    <p><strong>Umur:</strong> {{ $umur }} tahun</p>
                    <p><strong>Gender:</strong> {{ $gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                    <p><strong>Berat Badan:</strong> {{ $berat }} kg</p>
                    <p><strong>Tinggi Badan:</strong> {{ $tinggi }} cm</p>
                    <p><strong>BMI:</strong> {{ $bmi }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-danger text-white">
                    Diagnosis
                </div>
                <div class="card-body">
                    <h4 class="text-danger"><strong>{{ $diagnosa }}</strong></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            💡 Rekomendasi
        </div>
        <div class="card-body">
            <div style="white-space: pre-line;">{!! nl2br(e($rekomendasi)) !!}</div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning">
            🌿 Kebutuhan Serat
        </div>
        <div class="card-body">
            <p>{{ $serat }}</p>
        </div>
    </div>

    <div class="text-center">
        <a href="{{ route('form') }}" class="btn btn-outline-primary">
            🔄 Cek lagi
        </a>
    </div>
</div>
@endsection

@section('footer')
    <p class="text-center text-muted mt-5">&copy; 2024 Diet Bergizi</p>
@endsection
