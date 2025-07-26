<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactMessage;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build()
    {
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Website Contact: ' . $this->contactMessage->subject_display . ' - ' . $this->contactMessage->name)
                    ->view('emails.contact-form')
                    ->with([
                        'message' => $this->contactMessage
                    ]);
    }
}
