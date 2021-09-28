<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;
use App\Traits\ProdutosTrait;
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


    use ProdutosTrait;

    protected $list = [];

    //* Route de GET Listagem
    public function listagemDeProdutos(Request $request)
    {
        //? Método refatorado para a Trait ProdutosTrait.
        $result = $this->ListagemDeProdutosTrait($request);
        return Response($result, $result['status']);
    }

     //* Route de GET Listagem By Id
    public function listagemDeProdutosById(int $produtoId)
    {
         //? Método refatorado para a Trait ProdutosTrait.
        $result = $this->ListagemDeProdutosByIdTrait($produtoId);
        return Response($result, $result['status']);
    }

    //* Route de POST Cadastro
    public function cadastraProdutos(Request $request)
    {
        //? Método refatorado para a Trait ProdutosTrait.
        $result = $this->CreateProdutosTrait($request);
        return Response($result, $result['status']);
    }

    //* Route de PUT Atualizacao
    public function atualizarProdutos(Request $request, int $produtoId)
    {
        //? Método refatorado para a Trait ProdutosTrait.
        $result = $this->UpdateProdutosTrait($request, $produtoId);
        return Response($result, $result['status']);
    }

    //* Route de DELETE Atualizacao
    public function deleteProdutos(int $produtoId)
    {
        //? Método refatorado para a Trait ProdutosTrait.
        $result = $this->DeleteProdutosTrait($produtoId);
        return Response($result, $result['status']);
    }
}
