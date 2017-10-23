<?php

namespace App\Listeners;

use App\Events\FetchArticles;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class GetArticles implements ShouldQueue
{
    /**
     * The name of the connection the job should be sent to.
     *
     * @var string|null
     */
    public $connection = 'database';

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */
    public $queue = 'listeners';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  FetchArticles  $event
     * @return void
     */
    public function handle(FetchArticles $event)
    {
        \Log::info('Article is fetched:',['article'=>$event->article]);
    }
    public function failed(OrderShipped $event, $exception)
    {
        \Log::info('Faild to Queue is fetched:',['article'=>$event->article]);
    }
}
