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
                'nickname'  => 'cash',
                'icon'      => 'cogs',
            ])->data('priority', 600);

        // get configs menu group
        $configs = backend()->menu()->get('configs');

        $this
            // append items to submenu
            ->currencies($configs)
            ->cash_books($sub)
            ->cashes($sub)
            ->cashmovements($sub);

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

    private function cash_books(&$menu) {
        if (Route::has('backend.cash_books'))
            $menu->add(__('cash::cash_books.nav'), [
                'route'     => 'backend.cash_books',
                'icon'      => 'cash_books'
            ]);

        return $this;
    }

    private function cashes(&$menu) {
        if (Route::has('backend.cashes'))
            $menu->add(__('cash::cashes.nav'), [
                'route'     => 'backend.cashes',
                'icon'      => 'cashes'
            ]);

        return $this;
    }

    private function cashmovements(&$menu) {
        if (Route::has('backend.cashmovements'))
            $menu->add(__('cash::cashmovements.nav'), [
                'route'     => 'backend.cashmovements',
                'icon'      => 'cashmovements'
            ]);

        return $this;
    }

}
