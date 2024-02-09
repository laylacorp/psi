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

            {{-- Modal Tambah Data --}}
            <div class="modal fade" id="modal-kategori-job" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg" role="document">
                    <form id="form-kategori-job" action="" method="POST">
                        @csrf <!-- Tambahkan token CSRF -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Form Input Job</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">



                                <div class="card">

                                    <div class="card-block tab-icon">

                                        <div class="row">
                                            <div class="col-lg-12 col-xl-12">



                                                <ul class="nav nav-tabs md-tabs " role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#home7"
                                                            role="tab"><i class="fas fa-home"></i>Informasi Umum</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#profile7"
                                                            role="tab"><i class="fas fa-bookmark"></i>Ketentuan
                                                            Pekerjaan</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#messages7"
                                                            role="tab"><i class="fas fa-users"></i>Kualifikasi
                                                            Kandidat</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#settings7"
                                                            role="tab"><i class="fas fa-server"></i>Lainnya</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                </ul>

                                                <div class="tab-content card-block">
                                                    <div class="tab-pane active" id="home7" role="tabpanel">



                                                        <div class="modal-content">

                                                            <div class="modal-body">
                                                                <div class="card-block">
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="nama_job">Nama Job</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-success"
                                                                                id="nama_job" name="nama_job">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="tanggal_tutup">Tanggal Lowongan
                                                                                Ditutup</label>
                                                                            <input type="date"
                                                                                class="form-control form-control-success"
                                                                                id="tanggal_tutup" name="tanggal_tutup">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="gaji">Gaji</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-success"
                                                                                id="gaji" name="gaji">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="jenis_pembayaran">Jenis
                                                                                Pembayaran</label>
                                                                            <select
                                                                                class="form-control form-control-success"
                                                                                id="jenis_pembayaran"
                                                                                name="jenis_pembayaran" required>
                                                                                <option value="">--Pilih jenis
                                                                                    pembayaran--</option>
                                                                                <option value="Bulan">Bulan</option>
                                                                                <option value="Jam">Jam</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="estimasi_minimil">Estimasi IDR
                                                                                Min</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-success"
                                                                                id="estimasi_minimil"
                                                                                name="estimasi_minimil">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="estimasi_maksimal">Estimasi IDR
                                                                                Mak</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-success"
                                                                                id="estimasi_maksimal"
                                                                                name="estimasi_maksimal">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <label class="col-form-label"
                                                                                for="gaji_diterima">Gaji Yang
                                                                                Diterima</label>
                                                                            <select
                                                                                class="form-control form-control-success"
                                                                                id="gaji_diterima" name="gaji_diterima"
                                                                                required>
                                                                                <option value="">--Pilih gaji yang
                                                                                    diterima--</option>
                                                                                <option value="Bersih">Bersih</option>
                                                                                <option value="Kotor">Kotor</option>
                                                                            </select>

                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="tanggal_kurs">Tanggal Kurs</label>
                                                                            <input type="date"
                                                                                class="form-control form-control-success"
                                                                                id="tanggal_kurs" name="tanggal_kurs">
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="nominal_kurs">Nominal Kurs</label>
                                                                            <input type="text"
                                                                                class="form-control form-control-success"
                                                                                id="nominal_kurs" name="nominal_kurs">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="negara_id">Negara</label>

                                                                            <select id="negara_id" name="negara_id"
                                                                                class="form-control">
                                                                                <option value="">Pilih Negara
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-6">
                                                                            <label class="col-form-label"
                                                                                for="kategori_job_id">Industri
                                                                                Pekerjaan</label>
                                                                            <select id="kategori_job_id"
                                                                                name="kategori_job_id"
                                                                                class="form-control">
                                                                                <option value="">Pilih Industri
                                                                                    Pekerjaan</option>
                                                                            </select>
                                                                        </div>

                                                                    </div>



                                                                </div>
                                                            </div>


                                                        </div>




                                                    </div>
                                                    <div class="tab-pane" id="profile7" role="tabpanel">
                                                        <p class="m-0">2.Cras consequat in enim ut efficitur. Nulla
                                                            posuere elit quis auctor
                                                            interdum praesent sit amet nulla vel enim amet. Donec convallis
                                                            tellus neque, et
                                                            imperdiet felis amet.</p>
                                                    </div>
                                                    <div class="tab-pane" id="messages7" role="tabpanel">
                                                        <p class="m-0">3. This is Photoshop's version of Lorem IpThis is
                                                            Photoshop's version
                                                            of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.
                                                            Aenean sollicitudin,
                                                            lorem quis bibendum auctor, nisi elit consequat ipsum, nec
                                                            sagittis sem nibh id
                                                            elit. Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                                                            Aenean commodo
                                                            ligula eget dolor. Aenean mas Cum sociis natoque penatibus et
                                                            magnis dis.....</p>
                                                    </div>
                                                    <div class="tab-pane" id="settings7" role="tabpanel">
                                                        <p class="m-0">4.Cras consequat in enim ut efficitur. Nulla
                                                            posuere elit quis auctor
                                                            interdum praesent sit amet nulla vel enim amet. Donec convallis
                                                            tellus neque, et
                                                            imperdiet felis amet.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>







                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect "
                                    data-dismiss="modal">Kembali</button>
                                <button type="button" class="btn btn-primary waves-effect waves-light"
                                    id="btn-save-kategori-job"><i class="fas fa-save"></i> Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>







        @endsection




        @push('script')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            {{-- <script type="text/javascript" src="{{ asset('template') }}/files/bower_components/select2/js/select2.full.min.js">
            </script>
            <script type="text/javascript" src="{{ asset('template') }}/files/assets/pages/advance-elements/select2-custom.js">
            </script>
            <script type="text/javascript" src="{{ asset('template') }}/files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js">
            </script>
            <script type="text/javascript" src="{{ asset('template') }}/files/bower_components/multiselect/js/jquery.multi-select.js"></script> --}}


            {{-- PERINTAH CARI NEGARA --}}
            <script>
                $(document).ready(function() {
                    $.ajax({
                        url: '{{ route('negara.list') }}',
                        type: 'GET',
                        success: function(data) {
                            var options = '';
                            data.forEach(function(negara) {
                                options += '<option value="' + negara.id + '">' + negara.nama_negara +
                                    '</option>';
                            });
                            $('#negara_id').append(options);
                        }
                    });



                });
            </script>


            <script>
                $(document).ready(function() {
                    $.ajax({
                        url: '{{ route('kategori_job.list') }}',
                        type: 'GET',
                        success: function(data) {
                            console.log(data);
                            var options = '';
                            data.forEach(function(kategori_job) {
                                options += '<option value="' + kategori_job.id + '">' + kategori_job
                                    .nama_kategori_job + '</option>';
                            });
                            $('#kategori_job_id').append(options);
                        }

                    });



                });
            </script>


            {{-- <script>
                $(document).ready(function() {
                    $.ajax({
                        url: '{{ route('getKategoriJob') }}',
                        type: 'GET',
                        success: function(response) {
                            var kategoriJobList = response.kategoriJobList;
                            var options = '';

                            options += '<option value="">Pilih Industri Pekerjaan</option>';

                            $.each(kategoriJobList, function(id, nama_kategori_job) {
                                options += '<option value="' + id + '">' + nama_kategori_job +
                                    '</option>';
                            });

                            $('#kategori_job_id').html(options);
                        },
                        error: function(error) {
                            console.error("Error fetching kategori job data:", error);
                        }
                    });
                });
            </script> --}}





            {{-- TAMBAH --}}
            <script>
                $(document).ready(function() {
                    $('#btn-save-kategori-job').click(function() {
                        var form = $('#form-kategori-job');
                        $.ajax({
                            url: form.attr('action'),
                            type: 'POST',
                            data: form.serialize(),
                            success: function(response) {
                                $('#modal-kategori-job').modal('hide');
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
