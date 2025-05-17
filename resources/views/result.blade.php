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
                    <p><strong>Nama:</strong> {{ $diagnosisResult['nama'] }}</p>
                    <p><strong>Umur:</strong> {{ $diagnosisResult['usia'] }} tahun</p>
                    <p><strong>Gender:</strong> {{ $diagnosisResult['gender'] == 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                    <p><strong>Berat Badan:</strong> {{ $diagnosisResult['berat'] }} kg</p>
                    <p><strong>Tinggi Badan:</strong> {{ $diagnosisResult['tinggi'] }} cm</p>
                    <p><strong>BMI:</strong> {{ $diagnosisResult['bmi'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-danger text-white">
                    Diagnosis
                </div>
                <div class="card-body">
                    <h4 class="text-danger"><strong>{{ $diagnosisResult['diagnosis'] }}</strong></h4>
                    <p>{{ $diagnosisResult['kategori_bmi'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            💡 Rekomendasi
        </div>
        <div class="card-body">
            <ul>
                @foreach ($diagnosisResult['rekomendasi_diet'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    @if($diagnosisResult['fiber_recommendation'])
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning">
            🌿 Kebutuhan Serat
        </div>
        <div class="card-body">
            <p>{{ $diagnosisResult['fiber_recommendation'] }}</p>
        </div>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            🔍 Alasan Diagnosis
        </div>
        <div class="card-body">
            <p>
                Pasien memenuhi kriteria kategori <strong>{{ $diagnosisResult['diagnosis'] }}</strong> karena:
            </p>
            <ul>
                <li>BMI = {{ $diagnosisResult['bmi'] }} termasuk kategori <strong>{{ $diagnosisResult['diagnosis'] }}</strong></li>
                <li>Rule yang terpenuhi: <strong>{{ $diagnosisResult['rule_id'] ?? '-' }}</strong></li>
                <li>Kombinasi gejala dalam rule {{ $diagnosisResult['rule_id'] ?? '' }}:</li>
                <ul>
                    @foreach($diagnosisResult['rule_gejala_deskripsi'] as $g)
                        <li>{{ $g }}</li>
                    @endforeach
                </ul>
            </ul>
        </div>
    </div>


    <div class="text-center">
        <a href="{{ route('form') }}" class="btn btn-outline-primary">
            🔄 Cek Lagi
        </a>
    </div>
</div>
@endsection

@section('footer')
    <p class="text-center text-muted mt-5">&copy; 2024 Diet Bergizi</p>
@endsection
