<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendEmailMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Email;
use App\Models\User;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar-correos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Con esta comando se envian los correos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $emails = Email::where('estado', 'No enviado')->get();
        if($emails){
            foreach($emails as $mails){
                $email = new SendEmailMailable($mails->contenido);
                Mail::to($mails->destino)
                ->send($email);

                $info = [
                    'estado' => 'Enviado'
                ];

                $mails->update($info);
            }
        }
        
    }
}
