<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    public function run(Produtos $produtos)
{
    $produtos->create([
        'produtoId'=>'vision'
    ]);
}

    /**
     * Run the database seeds.
     *
     * @return void
     */

}
