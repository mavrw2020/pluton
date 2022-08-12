<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        Event::listen(BuildingMenu::class, function (BuildingMenu $event){

        $usuario= Auth()->User()->name;

        $notificacion = DB::table('notificacions')
                        ->where('leido','=',0)
                        ->where('destinatario','=',$usuario)
                        ->count();
                        

        $event->menu->add([
            'text'   => 'Notificaciones',
            'route'  => 'notificacion.index',
            'icon'   => 'far fa-fw fa-bell',
            'label'  => $notificacion,
            'label_color' => 'success',]);
        
        });

    }

}

