<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TestEvent extends Event
{
    use SerializesModels;

    public $testInfo = 'This Is Test Info!';

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($str='')
    {
        $this->testInfo .= $str;
        Log::notice($this->testInfo.'-Event ');
    }
}
