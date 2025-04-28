@extends('template-admin.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabel Menyusun Kata</h6>
                        <a href="{{ route('menyusun-kata.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="example" class="table table-striped nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Soal</th>
                                        <th>Jawaban</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menyusunKata as $item)
                                        <tr>
                                            <td>{{ $item->soal }}</td>
                                            <td>{{ $item->jawaban }}</td>
                                            <td>
                                               
                                                <a href="{{ route('menyusun-kata.edit', $item->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('menyusun-kata.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn btn-danger">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection