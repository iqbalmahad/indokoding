@extends('client.template.main')
@section('content')
<section >
    <div class="jumbotron">
        <div class="container">
            <p class="lead">ARTIKEL</p>
        </div>
    </div>        
</section>
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
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        filter artikel
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    
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
        </div>
    </div>
</div>
<!-- end list artikel -->
@endsection