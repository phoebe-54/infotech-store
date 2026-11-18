<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->get();

        return view('products.index', compact('products'));
    }

    // Afficher le formulaire d'ajout
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit ajouté avec succès !');
    }

    // Afficher le formulaire de modification
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'products.edit',
            compact('product', 'categories')
        );
    }

    // Enregistrer les modifications
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit modifié avec succès !');
    }

public function ordinateurs()
{
    $search = request('search');

    $products = Product::with('category')
        ->whereHas('category', function ($query) {
            $query->where('type', 'pc');
        })
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->get();

    return view('ordinateurs.index', compact('products'));
}

public function imprimantes()
{
    $search = request('search');

    $products = Product::with('category')
        ->whereHas('category', function ($query) {
            $query->where('type', 'imprimante');
        })
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhereHas('category', function ($categoryQuery) use ($search) {
                      $categoryQuery->where('name', 'like', "%{$search}%");
                  });
            });
        })
        ->get();

    return view('imprimantes.index', compact('products'));
}
public function createOrdinateur()
{
    $categories = Category::where('type', 'pc')
        ->orderBy('name')
        ->get();

    return view('ordinateurs.create', compact('categories'));
}

public function createImprimante()
{
    $categories = Category::where('type', 'imprimante')
        ->orderBy('name')
        ->get();

    return view('imprimantes.create', compact('categories'));
}

public function storeOrdinateur(Request $request)
{
    return $this->storeForType($request, 'pc');
}

public function storeImprimante(Request $request)
{
    return $this->storeForType($request, 'imprimante');
}

private function storeForType(Request $request, string $type)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'category_id' => [
            'required',
            \Illuminate\Validation\Rule::exists('categories', 'id')
                ->where('type', $type),
        ],
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')
            ->store('products', 'public');
    }

    Product::create($validated);

    $route = $type === 'pc'
        ? 'ordinateurs.index'
        : 'imprimantes.index';

    return redirect()->route($route)
        ->with('success', 'Produit ajouté avec succès !');
}

    // Supprimer un produit
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produit supprimé avec succès !');
    }
}
