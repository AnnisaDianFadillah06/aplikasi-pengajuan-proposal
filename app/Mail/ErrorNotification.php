<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $exception;

    /**
     * Create a new message instance.
     *
     * @param \Exception $exception
     */
    public function __construct(\Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Error Notification: An Issue Occurred in the Application')
        ->view('proposal_kegiatan.error_notification')
        ->with([
            'exceptionMessage' => $this->exception->getMessage(),
            'exceptionFile' => $this->exception->getFile(),
            'exceptionLine' => $this->exception->getLine(),
            'exceptionTrace' => $this->exception->getTraceAsString(),
        ]);
    
    }
}
