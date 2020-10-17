<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileViewed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;
    public $target;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($sender, $target)
    {
        $this->sender = $sender;
        $this->target = $target;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['profile-viewed'];
        // return ['profile-viewed'];
        // return new PrivateChannel('channel-name');
    }

    public function broadcastAs()
    {
        return "profile-".$this->target."-view";
    }
}
