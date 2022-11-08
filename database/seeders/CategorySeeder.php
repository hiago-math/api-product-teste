<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::query()->insert([
            [
                'name' => Str::upper('alimentos')
            ],
            [
                'name' => Str::upper('limpeza')
            ],
            [
                'name' => Str::upper('jardim')
            ],
            [
                'name' => Str::upper('carro')
            ],
        ]);
    }
}
