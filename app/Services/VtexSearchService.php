<?php

namespace App\Services;

//? Classe de serviço Search, que utiliza a conexão.
class VtexSearchService{
    use VtexConnect;

    public function searchServiceVtex($url)
    {

        $result = $this->connectGet($url)->collect();

        return $result->filter(function ($item) {
            return $item['productId'] == "1328137";

        })

            ->values();

    }

}
