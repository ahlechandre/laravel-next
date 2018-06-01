<?php

namespace Modules\User\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     *
     * @param  \Modules\User\Entities\User  $user
     * @return null|bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Indica se o usuário pode criar novos usuários.
     *
     * @param  \Modules\User\Entities\User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Indica se o usuário pode visualizar o outro usuário.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\User\Entities\User  $userToShow
     * @return bool
     */
    public function view(User $user, User $userToShow)
    {
        return true;
    }
}
