@extends('adminlte::page')

@section('title', 'Data Hospital')

@section('content_header')
    <h1 class="m-0 text-dark">Data Hospital</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <br>
                    <table class="table table-hover table-bordered table-stripped">
                        {{-- <table class="table table-hover "> --}}
                        <thead>
                            <tr>
                                <th>Nama Hospital</th>
                                <th>Alamat</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Jam Buka</th>
                                <th>Jam Tutup</th>
                                <th>Layanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hospitals as $key => $hospital)
                                <tr>
                                    <td>{{ $hospital->namahospital }}</td>
                                    <td>{{ $hospital->alamat }}</td>
                                    <td>{{ $hospital->latitude }}</td>
                                    <td>{{ $hospital->longitude }}</td>
                                    <td>{{ $hospital->jambuka }}</td>
                                    <td>{{ $hospital->jamtutup }}</td>
                                    <td>{{ $hospital->layanan }}</td>
                                    <td>
                                        <a href="{{ route('hospitals.show', $hospital->id) }}" class="btn btn-primary">Lihat</a>
                                        <!-- {{-- <a href="" class="btn btn-primary">Lihat</a> --}} -->
                                        <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-warning">Edit</a>
                                        <!-- {{-- <a href="" class="btn btn-warning">Edit</a> --}} -->
                                        <form action="{{ route('hospitals.destroy', $hospital->id) }}" id="delete-form-{{ $hospital->id }}" method="POST"
                                        
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <!-- {{-- <button type="submit" class="btn btn-danger">Hapus</button> --}} -->
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $hospital->id }})">Hapus</button>
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
@stop

<script>
    function confirmDelete(id) {
    if (confirm('Anda yakin ingin menghapus hospital ini?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>