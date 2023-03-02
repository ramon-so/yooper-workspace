<?php

namespace App\Services;

class CriarJson
{
    public function criarJsonBanner($qtd_banners){
        $banners = [];

        // Array dos banner
        for($i=0; $i < $qtd_banners; $i++){

            $banner = [
                "id" => "",
                "nome" => "",
                "link" => "",
                "image" => ""
            ];

            array_push($banners, $banner);

        }

        return $banners = json_encode($banners);
    }

    public function criarJsonProdutos($qtd_produtos){
        $produtos = [];
        // Array dos produtos
        for($i=0; $i < $qtd_produtos; $i++){
            $produto = [
                "id" => "",
                "nome" => "",
                "subtitulo" => "",
                "link" => "",
                "preco_antigo" => "",
                "preco_atual" => "",
                "desconto" => "",
                "promocao" => "",
                "image" => ""
            ];

        array_push($produtos, $produto);

    }

        return $produtos = json_encode($produtos);
    }
}


?>