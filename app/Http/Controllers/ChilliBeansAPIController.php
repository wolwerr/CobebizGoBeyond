<?php

namespace App\Http\Controllers;

use App\Services\VtexSearchService;


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

}
