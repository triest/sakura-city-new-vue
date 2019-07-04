<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMessageAboutEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message;
    protected $mail;
    protected $name;
    protected $event;
    protected $phone;
    protected $subject;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $mail, $name, $subject)
    {
        //
        $this->message = $message;
        $this->mail = $mail;
        $this->name = $name;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $name = $this->name;
        $mail = 'triest21@gmail.com';
        //echo $mail;
        try {
            Mail::send('email.notification', ['name' => $name], function ($message) use ($mail) {
                $message
                    ->to($mail, 'some guy')
                    //->from('newmail.sm@yandex.ru')
                    ->from('sakura-testmail@sakura-city.info')
                    ->subject('Новый вользователь');

            });

        } catch (\Exception $exception) {

        }
    }

}
