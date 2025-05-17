@extends('layouts.app')
@section('title', 'Form Cek Gizi')
@section('content')
    <div class="container mt-5 pt-5">
        <h1 class="mb-4 text-center">⭐ Sehatku sehatmu ⭐</h1>
        <form action="{{ route('diagnosis') }}" method="POST">
            @csrf
            
            <div class="form-floating mb-3">
                <input type="text" name="nama" id="umur" class="form-control" placeholder="Masukkan nama Anda" required>
                <label for="umur">Nama</label>
            </div>
            <div class="form-floating mb-3">
                <input type="number" name="umur" id="umur" class="form-control" placeholder="Masukkan umur Anda" required>
                <label for="umur">Age</label>
            </div>

            <div class="form-floating mb-3">
                <select name="gender" id="gender" class="form-select" required>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
                <label for="gender">Gender</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" name="berat" id="berat" step="0.1" class="form-control"placeholder="Masukkan berat badan Anda" required>
                <label for="berat">Weight</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" name="tinggi" id="tinggi" step="0.1" class="form-control" placeholder="Masukkan tinggi badan Anda" required>
                <label for="tinggi">Height</label>
            </div>
            <button type="button" class="btn btn-success" id="showGejalaBtn">Cek Kondisimu disini</button>

            <div id="gejalaSection" class="mt-4 d-none">
                <h5>Pertanyaan Gejala</h5>
                @foreach($gejalaPertanyaan as $kode => $data)
                    <div class="card mb-3 border-primary">
                        <div class="card-body">
                            <label class="form-label"><strong>{{ $data['pertanyaan'] }}</strong></label>
                            @foreach($data['opsi'] as $val => $label)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="gejala[{{ $kode }}]" id="{{ $kode . '_' . $val }}" value="{{ $val }}" required>
                                    <label class="form-check-label" for="{{ $kode . '_' . $val }}">
                                        {{ $label }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Cek Diagnosis</button>
            </div>
            
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const showBtn = document.getElementById('showGejalaBtn');
        const gejalaDiv = document.getElementById('gejalaSection');

        showBtn.addEventListener('click', function () {
            gejalaDiv.classList.remove('d-none');
            gejalaDiv.scrollIntoView({ behavior: 'smooth' });
        });
    });
</script>



@section('footer')
    <footer class="text-center mt-4">
        <p>&copy; 2023 Diet Bergizi</p>
    </footer>
@endsection
