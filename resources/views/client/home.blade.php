@extends('client.template.main')
@section('content')
    <!-- start jumbotron -->
    <section >
        <div class="jumbotron">
            <div class="container">
            <img class="navbar-brand m-3" src="{{ url('/img/logo-hikoding.png') }}">
                <p class="lead">Berkembang Bersama Hikoding: Pelajari Bahasa Pemrograman dan Framework seperti:</p>
                <ul id="logo-belajar" class="list-inline">
                    <li class="list-inline-item"><i class="fab fa-laravel fa-2xl"></i></li>
                    <li class="list-inline-item"><i class="fa-brands fa-golang fa-2xl"></i></li>
                    <li class="list-inline-item"><i class="fab fa-php fa-2xl"></i></li>
                    <li class="list-inline-item"><i class="fab fa-react fa-2xl"></i></li>
                    <li class="list-inline-item"><i class="fa-brands fa-vuejs fa-2xl"></i></li>
                </ul>
                <br class="my-5">
                  
                <button type="button" class="btn-gojek shadow-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Pilih yang mau dipelajari <span><i class="fa-solid fa-magnifying-glass"></i></span>
                </button>
            </div>
        </div>        
    </section>
    <!-- end jumbotron -->

    <!-- start list artikel -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div id="card-artikel" class="row">

                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')
                    @include('client.components.artikel_card')

                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 rounded shadow p-2 mb-4">
                    <div id="sidebar-kategori" class="card-body mb-3">
                        <h3>Kategori</h3>
                        <hr>
                        <div class="btn btn-light w-100 pt-3 pb-3 text-start"><h5><a href="/">tes</a></h5></div>
                        <div class="btn btn-light w-100 pt-3 pb-3 text-start"><h5><a href="/">tes</a></h5></div>
                        <div class="btn btn-light w-100 pt-3 pb-3 text-start"><h5><a href="/">tes</a></h5></div>
                        <div class="btn btn-light w-100 pt-3 pb-3 text-start"><h5><a href="/">tes</a></h5></div>
                        <div class="btn btn-light w-100 pt-3 pb-3 text-start"><h5><a href="/">tes</a></h5></div>
                        <div class="btn btn-light w-100 pt-3 pb-3 text-start"><h5><a href="/">tes</a></h5></div>
                    </div>
                </div>

                <div id="tags" class="card border-0 rounded shadow p-2">
                    <div id="sidebar-kategori" class="card-body mb-3">
                        <h3>Tag</h3>
                        <hr>
                        <div class="badge bg-info"><a href="">api</a></div>
                        <div class="badge bg-danger"><a href="">laravel</a></div>
                        <div class="badge bg-success"><a href="">vue</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end list artikel -->

    <!-- start modal -->
    <!-- Button trigger modal -->

  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-magnifying-glass"></i> Search</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <input type="search" name="search" id="" class="w-100">
            </div>
            <div class="modal-footer">
            </div>
        </div>
        </div>
    </div>
    <!-- end modal -->    
@endsection