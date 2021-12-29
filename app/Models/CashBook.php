<?php

namespace HDSSolutions\Laravel\Models;

use Illuminate\Database\Eloquent\Builder;

class CashBook extends X_CashBook {

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function cashes() {
        return $this->hasMany(Cash::class);
    }

    public function users() {
        return $this->belongsToMany(User::class)
            ->using(CashBookUser::class)
            ->withTimestamps();
    }

    public function scopeIsPublicFor(Builder $query, int|User|null $user = null) {
        return $query
            ->where('is_public', true)
            ->orWhereHas('users', fn($fUser) => $fUser->where('id', $user instanceof User ? $user->id : $user));
    }

}
