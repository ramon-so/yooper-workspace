<?php

namespace App\Services;

class EnviarArquivos
{
    
    public function configuracaoServidor($file){
        if ( ! isset( $file['foto_capa'] ) ) {
            exit('Nenhum arquivo enviado!');
        }else{
            $arquivo_imagem = $file['foto_capa'];
            $nome_imagem = strtolower($arquivo_imagem['name']);
            $arquivo_temp = $arquivo_imagem['tmp_name'];

            // ftp conection
            $servidor_ftp = 'ftp.yooper.com.br';
            $usuario_ftp = 'yooper';
            $senha_ftp = 'b4x9t8m3';
            $caminho = 'admin.yooper.com.br/images/cursos/capa/';

            $conexao_ftp = ftp_connect($servidor_ftp);
            $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
            if ( ! $login_ftp ) {
            exit('Usuário ou senha FTP incorretos.');
                }else{@ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);
            }
        }
    }

    public function config_fotoUsuario($file){
        if ( ! isset( $file['foto_usuario'] ) ) {
            exit('Nenhum arquivo enviado!');
        }else{
            $arquivo_imagem = $file['foto_usuario'];
            $nome_imagem = strtolower($arquivo_imagem['name']);
            $arquivo_temp = $arquivo_imagem['tmp_name'];

            // ftp conection
            $servidor_ftp = 'ftp.yooper.com.br';
            $usuario_ftp = 'yooper';
            $senha_ftp = 'b4x9t8m3';
            $caminho = 'admin.yooper.com.br/images/fotos-funcionarios/';

            $conexao_ftp = ftp_connect($servidor_ftp);
            $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
            if ( ! $login_ftp ) {
                exit('Usuário ou senha FTP incorretos.');
            }else{@ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);
            }
        }
    }


    public function enviarArquivoEmktUnico($file, $nome_pasta, $numero_pasta){
        if ( ! isset( $file['imagem_email'] ) ) {
            exit('Nenhum arquivo enviado!');
        }else{
        $arquivo_imagem = $file['imagem_email'];
        $nome_imagem = strtolower($arquivo_imagem['name']);
        $arquivo_temp = $arquivo_imagem['tmp_name'];

        // ftp conection
        $servidor_ftp = 'ftp.yooper.com.br';
        $usuario_ftp = 'yooper';
        $senha_ftp = 'b4x9t8m3';
        $caminho = 'email-marketing.yooper.com.br/email/'.$nome_pasta.'/email-marketing-'.$numero_pasta.'/';
        $conexao_ftp = ftp_connect($servidor_ftp);
        $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
        if ( ! $login_ftp ) {
            exit('Usuário ou senha FTP incorretos.');
        }else{            
            ftp_mkdir($conexao_ftp, $caminho);
            @ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);            
        }
        }
    }


    public function criarPastaNews($nome_pasta, $numero_pasta){
        $servidor_ftp = 'ftp.yooper.com.br';
        $usuario_ftp = 'yooper';
        $senha_ftp = 'b4x9t8m3';
        $caminho = 'email-marketing.yooper.com.br/email/'.$nome_pasta.'/email-marketing-'.$numero_pasta.'/';
        $conexao_ftp = ftp_connect($servidor_ftp);
        $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
        if ( ! $login_ftp ) {
            exit('Usuário ou senha FTP incorretos.');
        }else{
            ftp_mkdir($conexao_ftp, $caminho);
        }
    }

    public function enviarBannerEmktNews($file, $nome_pasta, $numero_pasta, $index){
        if (isset( $file['banner_'.strval($index)]))  {  
            $arquivo_imagem = $file['banner_'.strval($index)];
            $nome_imagem = strtolower($arquivo_imagem['name']);
            $arquivo_temp = $arquivo_imagem['tmp_name'];

            // ftp conection
            $servidor_ftp = 'ftp.yooper.com.br';
            $usuario_ftp = 'yooper';
            $senha_ftp = 'b4x9t8m3';
            $caminho = 'email-marketing.yooper.com.br/email/'.$nome_pasta.'/email-marketing-'.$numero_pasta.'/';
            $conexao_ftp = ftp_connect($servidor_ftp);
            $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
            if ( ! $login_ftp ) {
                exit('Usuário ou senha FTP incorretos.');
            }else{
                @ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);
            }
        }
    }
    public function enviarArquivoEmktNews($file, $nome_pasta, $numero_pasta, $index){
        if(isset($file['arquivo_'.strval($index)])){
            $arquivo_imagem = $file['arquivo_'.strval($index)];
            $nome_imagem = strtolower($arquivo_imagem['name']);
            $arquivo_temp = $arquivo_imagem['tmp_name'];

            // ftp conection
            $servidor_ftp = 'ftp.yooper.com.br';
            $usuario_ftp = 'yooper';
            $senha_ftp = 'b4x9t8m3';
            $caminho = 'email-marketing.yooper.com.br/email/'.$nome_pasta.'/email-marketing-'.$numero_pasta.'/';
            $conexao_ftp = ftp_connect($servidor_ftp);
            $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
            if ( ! $login_ftp ) {
                exit('Usuário ou senha FTP incorretos.');
            }else{
                @ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);
            }
        }
    }

    public function enviarAssinatura($file){

        if($file["image_sub"]["name"]){
            
            $arquivo_imagem = $file['image_sub'];
            $nome_imagem = 'subassinatura-yooper.png';
            $nome_imagem_backup = 'sub-'.date_format(NOW(), 'YmdHis').'.png';
            $arquivo_temp = $arquivo_imagem['tmp_name'];
            
            // ftp conection
            $servidor_ftp = 'ftp.yooper.com.br';
            $usuario_ftp = 'yooper';
            $senha_ftp = 'b4x9t8m3';
            $caminho = 'assinaturas/';
            $caminho_backup = 'assinaturas/subs-cadastradas/';
            $conexao_ftp = ftp_connect($servidor_ftp);
            $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
            if ( ! $login_ftp ) {
                exit('Usuário ou senha FTP incorretos.');
            }else{
                @ftp_put($conexao_ftp, $caminho_backup.$nome_imagem_backup, $arquivo_temp, FTP_BINARY);
                @ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);
            }
        }
        else{
            var_dump("NÃO ENTROU");
            exit();
        }
    }

    public function enviarAssinaturaColaborador($file){

        // var_dump($file["image_sub"]["name"]);

        // var_dump($file["imagem_nome_mostrar"]["name"]);
        // exit();
        

        if($file["image_sub"]["name"]){
            
            $arquivo_imagem = $file['image_sub'];
            $nome_imagem = $file["image_sub"]["name"];

            $arquivo_imagem_2 = $file['imagem_nome_mostrar'];
            $nome_imagem_2 = $file["imagem_nome_mostrar"]["name"];
            
            $arquivo_temp = $arquivo_imagem['tmp_name'];
            $arquivo_temp_2 = $arquivo_imagem_2['tmp_name'];
            
            // ftp conection
            $servidor_ftp = 'ftp.yooper.com.br';
            $usuario_ftp = 'yooper';
            $senha_ftp = 'b4x9t8m3';
            $caminho = 'assinaturas/perfil/';
            $conexao_ftp = ftp_connect($servidor_ftp);
            $login_ftp = @ftp_login($conexao_ftp, $usuario_ftp, $senha_ftp);
            if ( ! $login_ftp ) {
                exit('Usuário ou senha FTP incorretos.');
            }else{
                @ftp_put($conexao_ftp, $caminho.$nome_imagem, $arquivo_temp, FTP_BINARY);
                @ftp_put($conexao_ftp, $caminho.$nome_imagem_2, $arquivo_temp_2, FTP_BINARY);
            }
        }
        else{
            var_dump("NÃO ENTROU");
            exit();
        }
    }

}
