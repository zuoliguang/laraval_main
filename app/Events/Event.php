<?php

namespace App\Events;

abstract class Event
{
    /**
	 * 应用程序的事件侦听器映射。
	 *
	 * @var array
	 */
	protected $listen = [
	    'App\Events\TestEvent',
	    'App\Events\Test1Event',
	];
}
