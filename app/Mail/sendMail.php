<?php

namespace App\Mail;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data){
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        
        if(sizeof($this->data)<4){
            return $this->from('aguapppi2020@gmail.com',env('MAIL_FROM_NAME'))
            ->subject('Restablece tu cuenta')
            ->with($this->data)
            ->view('resetPassword');  
        }
        else{
            return $this->from('aguapppi2020@gmail.com',env('MAIL_FROM_NAME'))
            ->subject('Activa tu cuenta')
            ->with($this->data)
            ->view('confirmationEmail');
        }
    
    }
}
