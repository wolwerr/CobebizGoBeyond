<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ListagemProdutosResource;
use App\Models\Produtos;
use App\Services\RedisService;

trait ProdutosTrait
{

    use RedisService;

    public function CreateProdutosTrait(object $request) : array
    {

        $validator = Validator::make($request->all(), [

            'produtoNome' => 'required|string|max:120|min:1',
            'brand' => 'required|string'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
            ];
        }



        try {
            $produtoId = Produtos::create([

                'produtoNome' => $request->produtoNome,
                'brand' => $request->brand
            ]);
        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }

        return [
            'status' => 201,
            'data' => $produtoId
        ];
    }

    public function ListagemDeProdutosTrait(object $request) : array
    {
        $expiresAt = now()->addMinutes(1);
        if(isset($request->filter_produtoNome)){
            $list = Produtos::where(['produtoName' => $request->filter_produtoNome])->get();
        } else {
             //$this->setCacheTrait($value, "listagem-produtos");

            $cache = $this->getCacheById("produtoNome");
            if(is_array($cache)){
                if($cache['status'] === 404){
                    $list = Produtos::all()->toArray();
                    $this->setCacheTrait(json_encode($list), "produtoNome", $expiresAt);
                } else {
                    $list = $cache;
                }
            } else {
                $list = json_decode($cache, true);
            }
                $list = Produtos::all();
        }

        return [
            'status' => 200,
            'data' => ListagemProdutosResource::collection($list)->values(),
        ];
    }

    public function ListagemDeProdutosByIdTrait(int $produtoId) : array
    {
        $produtoId = Produtos::where(['produtoId' => $produtoId])->get();


        return [
            'status' => 200,
            'data' => ListagemProdutosResource::collection($produtoId)->values(),
        ];
    }

    public function UpdateProdutosTrait(object $request, int $produtoId) : array
    {

        $fieldsValidator = array_merge($request->all(), ['produtoId' => $produtoId]);

        $validator = Validator::make($fieldsValidator, [
            'produtoId' => 'required|int',
            'produtoNome' => 'required|string|max:120',
            'brand' => 'required|string',
        ]);
        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
            ];
        }
        try {
            $produtoId = Produtos::find($produtoId);
            $produtoId->produtoNome = $request->produtoNome;
            $produtoId->brand = $request->brand;
            $produtoId->save();
        }catch(\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }
        return [
            'status' => 201,
            'data' => $produtoId
        ];
    }

    public function DeleteProdutosTrait(int $produtoId) : array
    {
        $fieldsValidator = ['produtoId' => $produtoId];

        $validator = Validator::make($fieldsValidator, [
            'produtoId' => 'required|int'
        ]);

        if($validator->fails()){
            return [
                'status' => 406,
                'data' => $validator->errors()
            ];
        }

        $produtoId = Produtos::where('produtoId', $produtoId)->first();
        if(is_null($produtoId)) {
            return [
                'status' => 200,
                'msg' => 'registro já apagado.'
            ];
        }
        try {
            $produtoId->delete();
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'msg' => $e->getMessage(),
                'data' => []
            ];
        }
        return [
            'status' => 200,
            'msg' => 'registro apagado.'
        ];
    }
    //! Métodos especiais para Commands.

    public function CommandMethodCleanTableProdutos() : void
    {
        Produtos::truncate();
    }

    public function CommandMethodCreateRegistersFakerProdutos(int $quantity) : void
    {
        \App\Models\Produtos::factory($quantity)->create();
    }
}
