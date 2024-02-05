@extends('back.layouts.app')
@section('title', 'Halaman Belum Diverifikasi')
@section('subtitle', 'Menu Belum Diverifikasi')

@section('content')


    <div class="pcoded-content">

        <div class="page-header card">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="feather icon-list bg-c-blue"></i>
                        <div class="d-inline">
                            <h5>Belum Diverifikasi</h5>
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
                            <li class="breadcrumb-item"><a href="#!">Halaman Belum Diverifikasi</a>
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
                                        <h5>Data Belum Diverifikasi</h5>
                                       
                                    </div>
                                    <div class="card-block">
                                        <button type="button" class="btn btn-primary mobtn"><i class="fas fa-plus-circle"></i> Add Data</button>
                                        <br><br>
                                        <div class="dt-responsive table-responsive">
                                            <table id="multi-colum-dt" class="table table-striped table-bordered nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Negara</th>
                                                        <th>Employer</th>
                                                        <th>Comitment Fee</th>
                                                        <th>Industri Pekerjaan</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>
                                                        <td>1</td>
                                                        <td>Rafi Heryadi</td>
                                                        <td>Arab Saudi</td>
                                                        <td>Mariot Hotel</td>
                                                        <td>500.000</td>
                                                        <td>Hospitality</td>
                                                        <td class="text-center">
                                                            <a style="color: rgb(242, 236, 236)" href="#" class="btn btn-sm btn-primary btn-edit" data-toggle="modal" data-target="#modal-edit" data-id="" style="color: black">
                                                                <i class="fas fa-edit"></i> Detail
                                                            </a>
                                                            <a style="color: rgb(242, 236, 236)" href="#" class="btn btn-sm btn-success btn-verifikasi" data-toggle="modal" data-target="#modal-verifikasi" data-id="" style="color: black">
                                                                <i class="fas fa-edit"></i> Verifikasi
                                                            </a>
                                                            <button class="btn btn-sm btn-danger btn-hapus" data-id="" style="color: white">
                                                              <i class="fas fa-trash-alt"></i> Delete
                                                            </button>
                                                        </td>
                                                    </tr>
                                                   
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
        @endpush

        @push('css')
        @endpush
