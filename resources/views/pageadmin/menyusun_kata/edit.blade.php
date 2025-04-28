@extends('template-admin.layout')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Edit Data Menyusun Kata</h6>
                </div>
                <div class="card-body px-4 pt-4 pb-4">
                    <form action="{{ route('menyusun-kata.update', $menyusunKata->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        
                        <div class="col-12">
                            <label class="form-label">SOAL</label>
                            <input type="text" class="form-control text-uppercase" name="soal" value="{{ $menyusunKata->soal }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">JAWABAN</label>
                            <input type="text" class="form-control text-uppercase" name="jawaban" value="{{ $menyusunKata->jawaban }}" required>
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
