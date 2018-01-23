<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class MailCode extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var
     */
    public $type;

    /**
     * MailCode constructor.
     * @param User $user
     */
    public function __construct(User $user, $type)
    {
        $this->user = $user;
        $this->type = $type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_id = $this->user->id;
        $key = $user_id . ':' . $this->type;
        $code = rand(1000, 9999);
        Cache::set($key, $code, config('redis.' . $this->type));
        return $this->markdown('mails.code')
            ->with([
                'code' => $code,
                'lineText' => 'You are receiving this email because we received a ' . $this->type . ' email request for your account.'
            ]);
    }
}
