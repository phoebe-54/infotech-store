
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Modifier le produit</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nom du produit</label>
            <input type="text" id="name" name="name"
                   class="form-control"
                   value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description"
                      class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prix</label>
            <input type="number" id="price" name="price"
                   class="form-control" min="0" step="0.01"
                   value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" id="stock" name="stock"
                   class="form-control" min="0" step="1"
                   value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">Choisir une catégorie</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $product->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Nouvelle image (facultatif)</label>
            <input type="file" id="image" name="image"
                   class="form-control" accept="image/*">
        </div>

        @if ($product->image)
            <div class="mb-3">
                <p>Image actuelle :</p>
                <img src="{{ asset('storage/' . $product->image) }}"
                     alt="Image du produit" width="120">
            </div>
        @endif

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
