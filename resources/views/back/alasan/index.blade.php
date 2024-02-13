@extends('back.layouts.app')
@section('title', 'Halaman Alasan')
@section('subtitle', 'Menu Alasan')
@push('css')
@endpush

@section('content')


    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-list bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Alasan</h5>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class=" breadcrumb breadcrumb-title">
                            <li class="breadcrumb-item">
                                <a href="/"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item"><a href="#!">Halaman Alasan</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="pcoded-inner-content">

            <div class="main-body">
                <div class="page-wrapper">

                    <div class="page-body">
                        <div class="row">
                            <div class="col-sm-12">


                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Alasan</h5>

                                    </div>
                                    <div class="card-block">
                                        <button type="button" class="btn btn-primary mobtn" data-toggle="modal"
                                            data-target="#modal-alasan"><i class="fas fa-plus-circle"></i> Add
                                            Data</button>

                                        <br><br>

                                        <div class="dt-responsive table-responsive">
                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th width="15%">Judul</th>
                                                        <th width="5%">Urutan</th>
                                                        <th class="text-center" width="5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($alasan as $p)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $p->judul }}</td>
                                                            <td>{{ $p->urutan }}</td>
                                                            <td class="text-center">
                                                                <a style="color: rgb(242, 236, 236)" href="#"
                                                                    class="btn btn-sm btn-primary btn-edit"
                                                                    data-toggle="modal" data-target="#modal-edit"
                                                                    data-id="{{ $p->id }}" style="color: black">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                                <button class="btn btn-sm btn-danger btn-hapus"
                                                                    data-id="{{ $p->id }}" style="color: white">
                                                                    <i class="fas fa-trash-alt"></i> Delete
                                                                </button>
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

                </div>
            </div>

            {{-- Modal Tambah Data --}}
            <div class="modal fade" id="modal-alasan" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form id="form-alasan" action="" method="POST">
                        @csrf <!-- Tambahkan token CSRF -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Input Alasan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="card-block">

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="judul">Judul</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-success"
                                                id="judul" name="judul">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="keterangan">Keterangan </label>
                                        </div>
                                        <div class="col-sm-12">
                                           <textarea class="form-control form-control-success" name="keterangan" id="keterangan" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="urutan">Urutan </label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control form-control-success" id="urutan"
                                                name="urutan">
                                        </div>
                                    </div>

                                </div>





                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect "
                                    data-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="btn-save-alasan"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Modal Edit Data -->
            <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form id="form-edit-alasan" action="" method="POST">
                        @csrf <!-- Tambahkan token CSRF -->
                        @method('PUT') <!-- Tambahkan method PUT untuk update -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Edit Alasan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="card-block">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="edit_judul">Judul</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-success"
                                                id="edit_judul" name="judul">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="edit_keterangan">Keterangan </label>
                                        </div>
                                        <div class="col-sm-12">
                                           <textarea class="form-control form-control-success" name="keterangan" id="edit_keterangan" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="edit_urutan">Urutan</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control form-control-success"
                                                id="edit_urutan" name="urutan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="btn-update-alasan"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>




        @endsection




        @push('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



            {{-- TAMBAH --}}
            <script>
                $(document).ready(function() {
                    $('#btn-save-alasan').click(function() {
                        var form = $('#form-alasan');
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                $('#modal-alasan').modal('hide');
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                var errorMessages = xhr.responseJSON.errors;
                                var errorMessage = '';
                                $.each(errorMessages, function(key, value) {
                                    errorMessage += value + '<br>';
                                });
                                Swal.fire({
                                    title: 'Error!',
                                    html: errorMessage,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    });
                });
            </script>



            {{-- EDIT dan UPDATE --}}
            <script>
                $(document).ready(function() {
                    // Tampilkan data di modal edit
                    $('.btn-edit').click(function() {
                        var id = $(this).data('id');
                        $.ajax({
                            url: '/alasan/' + id + '/edit',
                            type: 'GET',
                            success: function(response) {
                                $('#edit_judul').val(response.judul);
                                $('#edit_urutan').val(response.urutan);
                                $('#edit_keterangan').val(response.keterangan);
                                // Set action form untuk update
                                $('#form-edit-alasan').attr('action', '/alasan/' + id);
                                $('#modal-edit').modal('show');
                            },
                            error: function(xhr) {
                                // Handle error
                            }
                        });
                    });

                    // AJAX untuk update data
                    $('#btn-update-alasan').click(function() {
                        var form = $('#form-edit-alasan');
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize() + '&_method=PUT',
                            success: function(response) {
                                $('#modal-edit').modal('hide');
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            error: function(xhr) {
                                var errorMessages = xhr.responseJSON.errors;
                                var errorMessage = '';
                                $.each(errorMessages, function(key, value) {
                                    errorMessage += value + '<br>';
                                });
                                Swal.fire({
                                    title: 'Error!',
                                    html: errorMessage,
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    });
                });
            </script>

            <script>
                $(document).ready(function() {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $('.btn-hapus').click(function() {
                        var id = $(this).data('id');

                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: 'Data akan dihapus permanen!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({

                                    url: '/alasan/' + id,
                                    type: 'DELETE',

                                    success: function(response) {
                                        Swal.fire({
                                            title: 'Sukses!',
                                            text: response.message,
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                        }).then(function() {
                                            location.reload();
                                        });
                                    },
                                    error: function(xhr) {
                                        // Handle error
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Gagal menghapus data.',
                                            icon: 'error',
                                            confirmButtonText: 'OK',
                                        });
                                    },
                                });
                            }
                        });
                    });
                });
            </script>
        @endpush
