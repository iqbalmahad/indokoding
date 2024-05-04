<!-- start navbar -->
<nav class="navbar navbar-expand-lg navbar-light navbar-gojek">
    <div class="container">
        <a href="/"><img class="navbar-brand" src="{{ url('img/logo-hikoding.png') }}"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('client.kategori.index') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('client.artikel.index') }}">Artikel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end navbar -->