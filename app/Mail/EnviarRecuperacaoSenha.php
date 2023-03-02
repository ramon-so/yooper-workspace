<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarRecuperacaoSenha extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $address = 'dev@yooper.com.br';
        $subject = 'Workspace - Solicitação de alteração de senha';
        $name = 'Workspace Yooper';

        $this->data->nome_funcionario = explode(' ', $this->data->nome_funcionario);
        $this->data->nome_funcionario = $this->data->nome_funcionario[0];
        
        return $this->view('layouts.email.recuperar-senha')
        ->from($address, $name)
        ->replyTo($address, $name)
        ->subject($subject)
        ->with([ 'usuario' => $this->data]);
    }
}
