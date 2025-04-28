@extends('template-admin.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Tabel Abjad Alfabet</h6>
                        @if ($abjadAlfabet->isEmpty())
                            <a href="{{ route('abjad-alfabet.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                        @endif
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table id="example" class="table table-striped nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Alfabet & Suara</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($abjadAlfabet as $item)
                                        <tr>
                                            <td>
                                                <table class="table table-borderless mb-0">
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex flex-wrap justify-content-start gap-4">
                                                                @foreach ($item->alfabet as $alfabet)
                                                                    <div class="d-flex flex-column align-items-center" style="min-width: 120px">
                                                                        <h6 class="badge bg-gradient-primary justify-content-center mb-2">{{ $alfabet['huruf'] }}</h6>
                                                                        @if($alfabet['suara'])
                                                                            <audio controls style="width: 110px">
                                                                                <source src="{{ asset($alfabet['suara']) }}" type="audio/mpeg">
                                                                                Browser Anda tidak mendukung elemen audio.
                                                                            </audio>
                                                                        @else
                                                                            <small class="text-muted">Tidak ada suara</small>
                                                                        @endif
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <a href="{{ route('abjad-alfabet.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('abjad-alfabet.destroy', $item->id) }}" method="POST"
                                                    style="display:inline;" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
