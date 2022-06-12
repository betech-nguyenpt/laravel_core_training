<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Modules\Admin\Entities\AdminNotification;

/**
 * When create PusherEvent
 * event(new PusherEvent($content, $url, $receiverId));
 * 
 * Pusher will create array(
 * [
 *      'content'   => $content,
 *      'url'       => $url,                           
 * ])
 * and sent to BROAD_CAST_ON channel
 * 
 * You can catch notify at BROADCAST_*_AS.$receiverId channel
 */
class PusherEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $content;
    public $url;
    private $receiverId;
    private $type;

    //-----------------------------------------------------
    // Constants
    //-----------------------------------------------------
    /** Channels the event broadcast on */
    const BROADCAST_ON          = "notification-channel";

    /** Channels the event broadcast as */
    const BROADCAST_ALL_AS      = "notification-event-all";
    const BROADCAST_ROLE_AS     = "notification-event-role";
    const BROADCAST_ONE_AS      = "notification-event-one";

    //-----------------------------------------------------
    // Utility methods
    //-----------------------------------------------------
    /**
     * Create a new event instance.
     *
     * @param String $created_by        Created by
     * @param String $content           Content of notify
     * @param String $url               URL of notify
     * @param int $receiverId           ID of recriver
     * @return void
     */
    public function __construct($type, $content, $url, $receiverId)
    {
        $this->type = $type;
        $this->content = $content;
        $this->url = $url;
        $this->receiverId = $receiverId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return self::BROADCAST_ON;
    }

    /**
     * Get the channels the event should broadcast as.
     *
     * @return \Illuminate\Broadcasting\Channel|string
     */
    public function broadcastAs()
    {
        switch ($this->type) {
            case AdminNotification::TYPE_SEND_ALL:
                return self::BROADCAST_ALL_AS;
                break;
            case AdminNotification::TYPE_SEND_ROLE:
                return self::BROADCAST_ROLE_AS . $this->receiverId;
                break;
            case AdminNotification::TYPE_SEND_ONE:
                return self::BROADCAST_ONE_AS . $this->receiverId;
                break;
            default:
                break;
        }
    }
}
