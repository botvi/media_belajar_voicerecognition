@extends('template-admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Data Belajar Membaca</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-4">
                    <form action="{{ route('belajar-membaca.store') }}" method="POST" class="row g-3">
                        @csrf
                        

                        <div class="col-12">
                            <label class="form-label">Konten</label>
                            <div id="konten-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="konten[]" required>
                                    <button type="button" class="btn btn-danger remove-konten">Hapus</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-konten">Tambah Konten</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-konten').addEventListener('click', function () {
            let container = document.getElementById('konten-container');
            let newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2');
            newField.innerHTML = `
                <input type="text" class="form-control" name="konten[]" required>
                <button type="button" class="btn btn-danger remove-konten">Hapus</button>
            `;
            container.appendChild(newField);
        });

        document.getElementById('konten-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-konten')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
