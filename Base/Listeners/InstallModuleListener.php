<?php

namespace Modules\Base\Listeners;

use Modules\Base\Events\InstallModuleEvent;

class InstallModuleListener
{
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
     * @param \Modules\Base\Events\InstallModuleEvent $event
     * @return void
     */
    public function handle(InstallModuleEvent $event)
    {
       // Ejecutar y guardar en cache la api
       exec('php artisan fetch:country');
       exec('php artisan fetch:states');
       exec('php artisan fetch:city');
    }
}
