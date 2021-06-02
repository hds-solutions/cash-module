<?php

namespace hDSSolutions\Finpar\Models\Policies;

use HDSSolutions\Finpar\Models\Cash as Resource;
use HDSSolutions\Finpar\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('cashes.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('cashes.crud.show');
    }

    public function create(User $user) {
        return $user->can('cashes.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('cashes.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('cashes.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('cashes.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('cashes.crud.destroy');
    }
}
