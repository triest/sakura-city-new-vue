<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    //
    public function testemail()
    {
        $testname = 'testname1';
        $mail = 'dmitry.tikhonenko@yandex.ru';
        echo $mail;
        try {
            Mail::send('email.test', ['name' => $testname], function ($message) use ($mail) {
                $message
                    ->to($mail, 'some guy')
                    //->from('newmail.sm@yandex.ru')
                    ->from('sakura-testmail@sakura-city.info')
                    ->subject('Welcome');

            });
        }
        catch (\Exception $exception){
            echo '<br>';
            echo 'error:'; echo '<br>';
            echo $exception->getMessage();
        }
    }
}
