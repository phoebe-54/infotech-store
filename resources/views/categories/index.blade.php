
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Imprimantes - InfoTech Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            InfoTech Store
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('products.index') }}" class="btn btn-light">
                Produits
            </a>
            <a href="{{ route('categories.create') }}" class="btn btn-warning">
                + Ajouter une catégorie
            </a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold">Gestion des catégories</h1>
            <p class="text-secondary">Organise les équipements informatiques.</p>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Description</th>
                            <th>Nombre de produits</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td class="fw-semibold">
                                    {{ $category->name }}
                                </td>
                                <td>
                                    {{ $category->description ?: 'Aucune description' }}
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        {{ $category->products_count }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                           class="btn btn-sm btn-success">
                                            Modifier
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}"
                                              method="POST"
                                              onsubmit="return confirm('Supprimer cette catégorie ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Aucune catégorie enregistrée.
                                    <a href="{{ route('categories.create') }}">
                                        Ajouter la première catégorie
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</body>
</html>
