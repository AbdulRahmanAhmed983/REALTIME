<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;


class NewNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     * $data => come from Homecontroller 
     */

        public $user_id;
        public $comment;
        public $post_id;
        public $date;
        public $time;


    public function __construct($data)
    {
        $this -> user_id = $data['user_id'];
        $this -> comment = $data['comment'];
        $this -> post_id = $data['post_id'];
        $this -> date    = date("Y M d",strtotime(Carbon::now()));
        $this -> time    = date("h:i A",strtotime(Carbon::now()));


    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('new-notification');
    }
}
