<?php

namespace hDSSolutions\Finpar\Models\Policies;

use HDSSolutions\Finpar\Models\CashMovement as Resource;
use HDSSolutions\Finpar\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CashMovementPolicy {
    use HandlesAuthorization;

    public function viewAny(User $user) {
        return $user->can('cash_movements.crud.index');
    }

    public function view(User $user, Resource $resource) {
        return $user->can('cash_movements.crud.show');
    }

    public function create(User $user) {
        return $user->can('cash_movements.crud.create');
    }

    public function update(User $user, Resource $resource) {
        return $user->can('cash_movements.crud.update');
    }

    public function delete(User $user, Resource $resource) {
        return $user->can('cash_movements.crud.destroy');
    }

    public function restore(User $user, Resource $resource) {
        return $user->can('cash_movements.crud.destroy');
    }

    public function forceDelete(User $user, Resource $resource) {
        return $user->can('cash_movements.crud.destroy');
    }
}
