<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\User;

class SendEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var User
     */
    public $user;

    /**
     * @var string
     */
    public $type;

    /**
     * @var array
     */
    public $other_params;

    /**
     * SendEmailEvent constructor.
     * @param User $user
     * @param string $type
     * @param array $other_params
     */
    public function __construct(User $user, $type = 'verify', $other_params = [])
    {
        $this->user = $user;
        $this->type = $type;
        $this->other_params = $other_params;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
