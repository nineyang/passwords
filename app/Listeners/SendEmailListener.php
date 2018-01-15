<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmailListener
{
    private $_prefix;

    private $_namespace;

    /**
     * SendEmailListener constructor.
     */
    public function __construct()
    {
        $this->_prefix = 'Mail';
        $this->_namespace = 'App\Mail\\';
    }

    /**
     * Handle the event.
     *
     * @param  SendEmailEvent $event
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $mail_object = $this->_namespace . $this->_prefix . ucfirst($event->type);
        try {
            Mail::to($event->user)->send(new $mail_object($event->user));
        } catch (\Exception $exception) {
            Log::debug('send email failed', [
                'error_msg' => $exception->getMessage(),
                'user_id' => $event->user->id
            ]);
        }
    }
}
