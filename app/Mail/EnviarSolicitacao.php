<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarSolicitacao extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        $subject = 'Workspace - Nova solicitação cadastrada';
        $name = 'Workspace Yooper';
        
        return $this->view('layouts.email.nova-solicitacao')
        ->from($address, $name)
        ->replyTo($address, $name)
        ->subject($subject)
        ->with([ 'solicitacao' => $this->data]);
    }
}
