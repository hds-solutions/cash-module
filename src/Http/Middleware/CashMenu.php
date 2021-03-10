<?php

namespace HDSSolutions\Finpar\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CashMenu {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // create a submenu
        $sub = backend()->menu()
            ->add(__('cash::cash.nav'), [
                'icon'  => 'cogs',
            ])->data('priority', 600);

        // get configs menu group
        $configs = backend()->menu()->get('configs');

        $this
            // append items to submenu
            ->currencies($configs);

        // continue witn next middleware
        return $next($request);
    }

    private function currencies(&$menu) {
        if (Route::has('backend.currencies'))
            $menu->add(__('cash::currencies.nav'), [
                'route'     => 'backend.currencies',
                'icon'      => 'currencies'
            ]);

        return $this;
    }

}
