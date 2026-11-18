<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       $categoriesPc = [
    'HP',
    'Dell',
    'Lenovo',
    'Apple',
    'ASUS',
    'Acer',
];

$categoriesImprimantes = [
    'Imprimante à jet d’encre',
    'Imprimante laser',
    'Imprimante multifonction',
    'Imprimante thermique',
];

foreach ($categoriesPc as $name) {
    \App\Models\Category::updateOrCreate(
        ['name' => $name],
        ['type' => 'pc']
    );
}

foreach ($categoriesImprimantes as $name) {
    \App\Models\Category::updateOrCreate(
        ['name' => $name],
        ['type' => 'imprimante']
    );
}
    }
}
