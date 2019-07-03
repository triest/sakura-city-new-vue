<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendMessageAboutEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $message;
    protected $mail;
    protected $name;
    protected $event;
    protected $phone;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $mail, $name, $phone, $event)
    {
        //
        $this->message = $message;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->event = $event;
        $this->name = $name;
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
        $mail2 = $this->mail;
        $event = $this->event;
        Mail::send('mail.test', ['name' => $name, 'event' => $event], function ($message) use ($mail2) {
            $message
                ->to($mail2, 'some guy')
                ->from('sakura-testmail@sakura-city.info')
                ->subject('Обновление ваших событий!');
        });

        return null;
    }

}
