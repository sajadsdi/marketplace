<?php

namespace Sajadsdi\Marketplace\Policies;

use Illuminate\Database\Eloquent\Model;

class GeneralPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(Model $user, Model $model): bool
    {
        return $this->isOwner($user, $model);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Model $user, Model $model): bool
    {
        return $this->isOwner($user, $model);
    }

    /**
     * Determine whether the user can see the model.
     */
    public function view(Model $user, Model $model): bool
    {
        return $this->isOwner($user, $model);
    }

    private function isOwner(Model $user, Model $model): bool
    {
        if (isset($user->id, $model->user_id)) {
            return $user->id == $model->user_id;
        }

        return false;
    }
}
