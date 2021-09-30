<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use App\Repositories\Eloquent\EventRepository;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\ModalityRepository;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use App\Repositories\Contracts\EventRepositoryInterface;
use App\Repositories\Eloquent\CategoryHasEventRepository;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ModalityRepositoryInterface;
use App\Repositories\Contracts\CategoryHasEventRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(ModalityRepositoryInterface::class, ModalityRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryHasEventRepositoryInterface::class, CategoryHasEventRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        //App::setLocale(App::currentLocale()); //Determina a localidade de acesso do sistema e adequa a liguagem ao usuŕio
        // App::setLocale('en');
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            // Add some items to the menu...

            // dd(session()->get('tenant_id'));

            if(session()->has('tenant_id') && session()->get('tenant_id')){

                $user = Auth::user();
                $items = array();
                if(count($user->tenant) > 1) {

                    foreach($user->tenant as $tenant) {
                       $item = [
                            'text' => $tenant->name,
                            'url' => route('setTenantId', $tenant->id),
                            'topnav' => true,
                       ];
                       $items[] = $item;
                    }

                    $tenanto_current = Tenant::find(session()->get('tenant_id'));

                    $menu = [
                        'text'    => $tenanto_current->name,
                        'icon'    => 'fas fa-fw fa-profile',
                        'topnav' => true,
                        'submenu' => $items,
                    ];

                    $event->menu->add($menu);

                }
            }
        });

        Blade::directive('money', function ($amount) {
            return "<?php echo 'R$' . number_format($amount, 2); ?>";
        });
    }
}
