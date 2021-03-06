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

        // $this
        //     // append items to submenu
        //     ->cash($sub);

        // continue witn next middleware
        return $next($request);
    }

    private function cash(&$menu) {
        if (Route::has('backend.cash'))
            $menu->add(__('cash::cash.nav'), [
                'route'     => 'backend.cash',
                'icon'      => 'cash'
            ]);

        return $this;
    }

}
