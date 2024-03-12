<?php

namespace App;

use Illuminate\Support\Facades\Mail;

class Mailer
{
    public static function sendTestEmail($recipient, $subject, $body)
{
    Mail::send([], [], function ($message) use ($recipient, $subject, $body) {
        $message->to($recipient)
                ->subject($subject)
                ->setBody($body);
    });
}

}
