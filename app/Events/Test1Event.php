<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Test1Event extends Event
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
        echo $this->testInfo." -Test1Event 触发事件 ！";
        // Log::notice($this->testInfo.'-Event ');
    }
}
