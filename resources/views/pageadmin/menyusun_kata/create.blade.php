@extends('template-admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Data Menyusun Kata</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-4">
                    <form action="{{ route('menyusun-kata.store') }}" method="POST" class="row g-3">
                        @csrf
                        
                        <div class="col-12">
                            <label class="form-label">SOAL</label>
                            <input type="text" class="form-control text-uppercase mb-2" id="soalInput" name="soal" oninput="updateJawaban(this.value)" required>
                            <button type="button" class="btn btn-primary" onclick="acakHuruf()">Acak Huruf</button>
                        </div>
                        <div class="col-12">
                            <label class="form-label">JAWABAN</label>
                            <input type="text" class="form-control text-uppercase" id="jawabanInput" name="jawaban" required readonly>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
function updateJawaban(value) {
    document.getElementById('jawabanInput').value = value.toUpperCase();
}

function acakHuruf() {
    let input = document.getElementById('soalInput');
    let text = input.value;
    if(!text) return;
    
    let hurufArray = text.split('');
    for (let i = hurufArray.length - 1; i > 0; i--) {
        let j = Math.floor(Math.random() * (i + 1));
        [hurufArray[i], hurufArray[j]] = [hurufArray[j], hurufArray[i]];
    }
    input.value = hurufArray.join('').toUpperCase();
}
</script>
@endsection
