<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoticeEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $header = 'با عرض سلام و خسته نباشید';
        $content1 = 'این ایمیل از سایت فروشگاه به شما ارسال شده است.';
        $content = $this->content;
        $footer = '&copy;'. date('Y'). config('app.name').'All rights reserved.';

        return $this->subject(config('app.name'))
            ->view('vendor.mail.html.layout',compact('header','content','footer'));
    }
}
