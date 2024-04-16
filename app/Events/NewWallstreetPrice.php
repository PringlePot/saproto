<?php

namespace App\Events;

use App\Models\WallstreetPrice;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Contracts\Events\ShouldDispatchAfterCommit;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewWallstreetPrice implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public WallstreetPrice $wallstreetPrice
    )
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('wallstreet-prices.' . $this->wallstreetPrice->wallstreet_drink_id),
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'data' => $this->wallstreetPrice,
            'product' => $this->wallstreetPrice->product,
        ];
    }
}