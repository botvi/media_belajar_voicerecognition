@extends('template-admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Data Belajar Membaca</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-4">
                    <form action="{{ route('belajar-membaca.update', $belajarMembaca->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')

                      
                        <div class="mb-3">
                            <label class="form-label">Konten</label>
                            <div id="konten-container">
                                @foreach ($belajarMembaca->konten as $index => $konten)
                                    <div class="input-group mb-2">
                                        <input type="text" name="konten[]" class="form-control" value="{{ $konten }}" required>
                                        <button type="button" class="btn btn-danger remove-konten {{ $index == 0 ? 'd-none' : '' }}">Hapus</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-success" id="add-konten">Tambah Konten</button>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
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
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("add-konten").addEventListener("click", function() {
            let container = document.getElementById("konten-container");
            let newField = document.createElement("div");
            newField.classList.add("input-group", "mb-2");
            newField.innerHTML = `
                <input type="text" name="konten[]" class="form-control" placeholder="Masukkan konten" required>
                <button type="button" class="btn btn-danger remove-konten">Hapus</button>
            `;
            container.appendChild(newField);
            updateRemoveButtons();
        });
    
        document.getElementById("konten-container").addEventListener("click", function(e) {
            if (e.target.classList.contains("remove-konten")) {
                e.target.parentElement.remove();
                updateRemoveButtons();
            }
        });
    
        function updateRemoveButtons() {
            let buttons = document.querySelectorAll(".remove-konten");
            buttons.forEach((btn, index) => {
                btn.classList.toggle("d-none", index === 0);
            });
        }
    
        updateRemoveButtons();
    });
    </script>
@endsection
