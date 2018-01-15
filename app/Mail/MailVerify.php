<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Cache;

class MailVerify extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var User
     */
    protected $user;

    /**
     * MailVerify constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user_id = $this->user->id;
        $key = $user_id . ':verify';
        $value = md5($user_id . time());
        Cache::set($key, $value, config('redis.verify'));
        return $this->view('mails.verify')
            ->with([
                'url' => request()->fullUrl() . '?' . http_build_query([
                        'uid' => $user_id,
                        'token' => $value
                    ])
            ]);
    }
}
