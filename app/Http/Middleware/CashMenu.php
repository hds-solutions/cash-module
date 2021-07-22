<?php

namespace HDSSolutions\Laravel\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CashMenu extends Base\Menu {

    public function handle($request, Closure $next) {
        // create a submenu
        $sub = backend()->menu()
            ->add(__('cash::cash.nav'), [
                'nickname'  => 'cash',
                'icon'      => 'stamp',
            ])->data('priority', 600);

        // get configs menu group
        $configs = backend()->menu()->get('configs');

        $this
            // append items to submenu
            ->currencies($configs)
            ->cash_books($sub)
            ->cashes($sub)
            ->cash_movements($sub);

        // continue witn next middleware
        return $next($request);
    }

    private function currencies(&$menu) {
        if (Route::has('backend.currencies') && $this->can('currencies'))
            $menu->add(__('cash::currencies.nav'), [
                'route'     => 'backend.currencies',
                'icon'      => 'dollar-sign'
            ]);

        return $this;
    }

    private function cash_books(&$menu) {
        if (Route::has('backend.cash_books') && $this->can('cash_books'))
            $menu->add(__('cash::cash_books.nav'), [
                'route'     => 'backend.cash_books',
                'icon'      => 'book'
            ]);

        return $this;
    }

    private function cashes(&$menu) {
        if (Route::has('backend.cashes') && $this->can('cashes'))
            $menu->add(__('cash::cashes.nav'), [
                'route'     => 'backend.cashes',
                'icon'      => 'cash-register'
            ]);

        return $this;
    }

    private function cash_movements(&$menu) {
        if (Route::has('backend.cash_movements') && $this->can('cash_movements'))
            $menu->add(__('cash::cash_movements.nav'), [
                'route'     => 'backend.cash_movements',
                'icon'      => 'money-bill-wave'
            ]);

        return $this;
    }

}
