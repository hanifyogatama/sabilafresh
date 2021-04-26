@extends('admin.layout')

@section('content')
<div class="section-header">
    <h1>Panduan</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"> <a href="{{url('admin/guides')}}"><i class="fas fa-pencil-ruler"></i> Panduan</a> </div>
    </div>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#userRole" role="tab" aria-controls="home" aria-selected="true">User & Role</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#katalog" role="tab" aria-controls="profile" aria-selected="false">Katalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#cekPemesanan" role="tab" aria-controls="contact" aria-selected="false">Cek Pemesanan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#laporan" role="tab" aria-controls="contact" aria-selected="false">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#setting" role="tab" aria-controls="contact" aria-selected="false">Setting</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="userRole" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu user</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span>. Namun, hanya admin dapat melakukan pengeditan data user lain dan menghapus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu role</div>
                                            <p>Pada bagian menu ini hanya dapat di akses oleh <span class="text-primary">Admin </span> dan dapat melakukan penambahan perijinan mengakses pengeditan data.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="katalog" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu produk</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span>. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu kategori</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu atribut produk</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="cekPemesanan" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu pemesanan</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span>. </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="laporan" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu laporan produk</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span>. </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu laporan </div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="row">
                                <div class="col">
                                    <div class="border alert text-dark alert-has-icon p-4 mt-3">
                                        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
                                        <div class="alert-body">
                                            <div class="alert-title">Menu setting</div>
                                            <p>Pada bagian menu ini dapat di akses oleh <span class="text-primary">Admin </span>dan <span class="text-primary">Owner</span>. </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection