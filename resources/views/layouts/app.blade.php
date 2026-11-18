
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>InfoTech Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                InfoTech Store
            </a>
            <div>
                <a href="{{ route('ordinateurs.index') }}"
                   class="btn btn-outline-light btn-sm">Ordinateurs</a>

                <a href="{{ route('imprimantes.index') }}"
                   class="btn btn-outline-light btn-sm">Imprimantes</a>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

</body>
</html>