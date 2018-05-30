<?php

namespace Modules\User\Repositories;

use Modules\User\Entities\User;
use Illuminate\Support\Collection;

class UserRepository
{

    /**
     * Lista todos os usuários.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  null|int  $perPage
     * @param  null|string  $filter
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(User $user, $perPage = null, $filter = null)
    {
        $search = function ($filter) {
            $filterLike = "%{$filter}%";

            return User::where([
                ['name', 'like', $filterLike],
            ]);
        };
        $query = $filter ?
            $search($filter) :
            User::query();
        $users = $perPage ?
            $query->simplePaginate($perPage) :
            $query->get();

        return $users;
    }
}
