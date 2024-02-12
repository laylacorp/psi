@extends('back.layouts.app')
@section('title', 'Halaman Job')
@section('subtitle', 'Menu Job')
@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('template') }}/files/bower_components/select2/css/select2.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/files/bower_components/multiselect/css/multi-select.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('template') }}/custom.css" />
@endpush

@section('content')


    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-list bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Job</h5>
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
                            <li class="breadcrumb-item"><a href="#!">Halaman Job</a>
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
                                        <h5>Data Job</h5>

                                    </div>
                                    <div class="card-block">
                                        <a href="/job/create" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Data</a>

                                        <br><br>

                                        <div class="dt-responsive table-responsive">
                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>

                                                        <th width="15%">Nama Job</th>
                                                        <th width="5%">Negara</th>
                                                        <th class="text-center" width="5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($job as $p)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $p->nama_job }}</td>
                                                            <td>{{ $p->nama_negara }}</td>
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

         

        @endsection




        @push('script')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            

            {{-- EDIT dan UPDATE --}}
            <script>
                $(document).ready(function() {
                    // Tampilkan data di modal edit
                    $('.btn-edit').click(function() {
                        var id = $(this).data('id');
                        $.ajax({
                            url: '/job/' + id + '/edit',
                            type: 'GET',
                            success: function(response) {
                                $('#edit_nama_job').val(response.nama_job);
                                $('#edit_urutan').val(response.urutan);
                                // Set action form untuk update
                                $('#form-edit-kategori-job').attr('action', '/job/' + id);
                                $('#modal-edit').modal('show');
                            },
                            error: function(xhr) {
                                // Handle error
                            }
                        });
                    });

                    // AJAX untuk update data
                    $('#btn-update-kategori-job').click(function() {
                        var form = $('#form-edit-kategori-job');
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

            {{-- DELET --}}
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

                                    url: '/job/' + id,
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
