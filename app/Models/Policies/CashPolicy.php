<?php

namespace hDSSolutions\Laravel\Models\Policies;

use HDSSolutions\Laravel\Models\Cash as Resource;
use HDSSolutions\Laravel\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('cashes.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('cashes.crud.show') && $resource->isPublicFor($user);
    }

    public function create(User $user) {
        return $user->can('cashes.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('cashes.crud.update') && $resource->isPublicFor($user);
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
