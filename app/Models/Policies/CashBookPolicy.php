<?php

namespace hDSSolutions\Finpar\Models\Policies;

use HDSSolutions\Finpar\Models\CashBook as Resource;
use HDSSolutions\Finpar\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashBookPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('cash_books.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('cash_books.crud.show');
    }

    public function create(User $user) {
        return $user->can('cash_books.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('cash_books.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('cash_books.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('cash_books.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('cash_books.crud.destroy');
    }
}
