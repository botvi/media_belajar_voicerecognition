@extends('template-admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tambah Data Abjad Alfabet</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-4">
                    <form action="{{ route('abjad-alfabet.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">Alfabet dan Suara</label>
                            <div id="alfabet-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="alfabet[]" placeholder="Masukkan huruf" required>
                                    <input type="file" class="form-control" name="suara[]" accept=".mp3,.wav" required>
                                    <button type="button" class="btn btn-danger remove-alfabet">Hapus</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-success mt-2" id="add-alfabet">Tambah Alfabet</button>
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
        const container = document.getElementById('alfabet-container');
        const addBtn = document.getElementById('add-alfabet');

        addBtn.addEventListener('click', function () {
            const newGroup = document.createElement('div');
            newGroup.classList.add('input-group', 'mb-2');
            newGroup.innerHTML = `
                <input type="text" class="form-control" name="alfabet[]" placeholder="Masukkan huruf" required>
                <input type="file" class="form-control" name="suara[]" accept=".mp3,.wav" required>
                <button type="button" class="btn btn-danger remove-alfabet">Hapus</button>
            `;
            container.appendChild(newGroup);
        });

        container.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-alfabet')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endsection
