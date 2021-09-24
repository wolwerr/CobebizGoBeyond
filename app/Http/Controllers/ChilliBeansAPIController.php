<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;
use Illuminate\Http\Request;


class ChilliBeansAPIController extends Controller
{

    protected $endpointSearch;

    public function __construct()
    {

        $this->endpointSearch = new VtexSearchService();
    }


    public function listagemSearchVtex()
    {

        return $this->endpointSearch->searchServiceVtex("https://loja.chillibeans.com.br/api/catalog_system/pub/products/search/Vision&1328137");

    }

    //* Route de POST Cadastro
    public function cadastraProdutos(Request $request)
    {
        //? Método refatorado para a Trait PessoasTrait.
        $result = $this->CreatePessoasTrait($request);
        return Response($result, $result['status']);
    }
}
