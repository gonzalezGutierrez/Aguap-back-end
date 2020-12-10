<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class confirmarCuenta extends Mailable{

    use Queueable, SerializesModels;

    public $data;

    public function __construct($data){
        $this->data=$data;
    }

    public function build(){
        return $this->from('aguapppi2020@gmail.com',env('MAIL_FROM_NAME'))
        ->subject('Activa tu cuenta')
        ->with($this->data)
        ->view('confirmationEmail');
    }

}
