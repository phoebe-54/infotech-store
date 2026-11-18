
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajouter une catégorie - InfoTech Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            InfoTech Store
        </a>
        <a href="{{ route('categories.index') }}" class="btn btn-light">
            Retour aux catégories
        </a>
    </div>
</nav>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 fw-bold mb-2">Ajouter une catégorie</h1>
                    <p class="text-secondary">
                        Crée une catégorie pour classer tes produits.
                    </p>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">
                                Nom de la catégorie
                            </label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="form-control"
                                value="{{ old('name') }}"
                                placeholder="Ex. Ordinateurs"
                                required
                            >
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">
                                Description
                            </label>
                            <textarea
                                id="description"
                                name="description"
                                class="form-control"
                                rows="4"
                                placeholder="Description de la catégorie"
                            >{{ old('description') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Enregistrer la catégorie
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
