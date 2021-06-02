<?php

namespace hDSSolutions\Finpar\Models\Policies;

use HDSSolutions\Finpar\Models\Currency as Resource;
use HDSSolutions\Finpar\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('currencies.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('currencies.crud.show');
    }

    public function create(User $user) {
        return $user->can('currencies.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('currencies.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('currencies.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('currencies.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('currencies.crud.destroy');
    }
}
