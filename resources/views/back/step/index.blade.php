@extends('back.layouts.app')
@section('title', 'Halaman Step')
@section('subtitle', 'Menu Step')
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
                            <h5>Step</h5>
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
                            <li class="breadcrumb-item"><a href="#!">Halaman Step</a>
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
                                        <h5>Data Step</h5>

                                    </div>
                                    <div class="card-block">
                                        <button type="button" class="btn btn-primary mobtn" data-toggle="modal"
                                            data-target="#modal-step"><i class="fas fa-plus-circle"></i> Add
                                            Data</button>

                                        <br><br>

                                        <div class="dt-responsive table-responsive">
                                            <table id="order-table" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>

                                                        <th width="15%">Nama Step</th>
                                                        <th width="5%">Urutan</th>
                                                        <th width="5%">Gambar</th>
                                                        <th class="text-center" width="5%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($step as $p)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $p->nama_step }}</td>
                                                            <td>{{ $p->urutan }}</td>
                                                            <td>
                                                                <a href="/upload/step/{{ $p->gambar }}"
                                                                    target="_blank">
                                                                    <img style="max-width:50px; max-height:50px"
                                                                        src="/upload/step/{{ $p->gambar }}"
                                                                        alt="">
                                                                </a>
                                                            </td>
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
            <div class="modal fade" id="modal-step" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form id="form-step" action="" method="POST" enctype="multipart/form-data">
                        @csrf <!-- Tambahkan token CSRF -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Input Step</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="card-block">

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="nama_step">Nama Step</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-success" id="nama_step"
                                                name="nama_step">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="keterangan">Keterangan</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea class="form-control form-control-success" name="keterangan" id="keterangan" cols="30" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="urutan">Urutan</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control form-control-success"
                                                id="urutan" name="urutan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="gambar">Upload Gambar Step</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control form-control-success"
                                                id="gambar" name="gambar">
                                        </div>
                                    </div>

                                </div>





                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect "
                                    data-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="btn-save-step"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Modal Edit Data -->
            <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <form id="form-edit-step" action="" method="POST">
                        @csrf <!-- Tambahkan token CSRF -->
                        @method('PUT') <!-- Tambahkan method PUT untuk update -->
                        <input type="hidden" id="id" name="id">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Edit Step</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">


                                <div class="card-block">

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="edit_nama_step">Nama Step</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control form-control-success"
                                                id="edit_nama_step" name="nama_step">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="col-form-label" for="edit_keterangan">Keterangan</label>
                                        </div>
                                        <div class="col-sm-12">
                                            <textarea class="form-control form-control-success" name="keterangan" id="edit_keterangan" cols="30"
                                                rows="3"></textarea>
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
                                    <div class="form-group" id="gambar_edit_container">
                                        <label for="gambar_edit">Bukti Pengeluaran</label>

                                        <input type="file" class="form-control" name="gambar" id="gambar_edit">

                                        <div id="gambar_image_container"></div>
                                        <br>
                                        <!-- Tautan untuk mengunduh atau melihat gambar -->
                                        <a id="gambar_download_link" href="" target="_blank">

                                        </a>
                                    </div>


                                </div>





                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect"
                                    data-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="btn-update-step"><i class="fas fa-save"></i> Simpan Perubahan</button>
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
                    $('#btn-save-step').click(function() {
                        event.preventDefault();
                        const tombolSimpan = $('#btn-save-step')
                        var form = $('#form-step');
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: new FormData(form[0]),
                            contentType: false,
                            beforeSend: function() {
                                $('form').find('.error-message').remove()
                                tombolSimpan.prop('disabled', true)
                            },
                            processData: false,
                            success: function(response) {
                                $('#modal-step').modal('hide');
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(function() {
                                    location.reload();
                                });
                            },
                            complete: function() {
                                tombolSimpan.prop('disabled', false);
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




            {{-- PERINTAH EDIT DATA --}}
            <script>
                $(document).ready(function() {
                    // $('.dataTable tbody').on('click', 'td .btn-edit', function(e) {
                    $('.btn-edit').click(function(e) {
                        e.preventDefault();

                        var id = $(this).data('id');

                        $.ajax({
                            step: 'GET',
                            url: '/step/' + id + '/edit',
                            success: function(data) {
                                // console.log(data); // Cek apakah data terisi dengan benar
                                // Mengisi data pada form modal
                                $('#id').val(data.id); // Menambahkan nilai id ke input tersembunyi
                                $('#edit_nama_step').val(data.nama_step);
                                $('#edit_keterangan').val(data.keterangan);
                                $('#edit_urutan').val(data.urutan);
                                if (data.gambar) {
                                    var gambarImg = '<img src="/upload/step/' + data.gambar +
                                        '" style="max-width: 100px; max-height: 100px;">';
                                    var gambarLink = '<a href="/upload/step/' + data.gambar +
                                        '" target="_blank"><i class="fa fa-eye"></i> Lihat Bukti</a>';
                                    $('#gambar_edit_container').append(gambarImg + '<br>' + gambarLink);
                                }

                                $('#modal-step-edit').modal('show');
                                $('#id').val(id);
                            },

                            error: function(xhr) {
                                // Tangani kesalahan jika ada
                                alert('Error: ' + xhr.statusText);
                            }
                        });
                    });
                });
            </script>


            {{-- PERINTAH UPDATE DATA --}}
            <script>
                $(document).ready(function() {
                    $('#btn-update-step').click(function(e) {
                        e.preventDefault();
                        const tombolUpdate = $('#btn-update-step');
                        var id = $('#id').val();
                        var formData = new FormData($('#form-edit-step')[0]);

                        $.ajax({
                            type: 'POST',
                            url: '/step/update/' + id,
                            data: formData,
                            headers: {
                                'X-HTTP-Method-Override': 'PUT'
                            },
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('form').find('.error-message').remove();
                                tombolUpdate.prop('disabled', true);
                            },
                            success: function(response) {
                                $('#modal-step-edit').modal('hide');
                                Swal.fire({
                                    title: 'Sukses!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed || result.isDismissed) {
                                        location.reload();
                                    }
                                });
                            },
                            complete: function() {
                                tombolUpdate.prop('disabled', false);
                            },
                            error: function(xhr) {
                                if (xhr.status !== 422) {
                                    $('#modal-step-edit').modal('hide');
                                }
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


            {{-- HAPUS DATA --}}
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

                                    url: '/step/' + id,
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
