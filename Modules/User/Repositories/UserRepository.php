<?php

namespace Modules\User\Repositories;

use Exception;
use Modules\User\Entities\Role;
use Modules\User\Entities\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

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
            User::orderBy('created_at', 'desc');
        $users = $perPage ?
            $query->simplePaginate($perPage) :
            $query->get();

        return $users;
    }

    /**
     * Tenta criar um novo usuário.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  array  $inputs
     * @return stdClass
     */
    public function store(User $user, array $inputs)
    {
        if ($user->cant('create', User::class)) {
            // Permissão negada.
            return apiResponse(403);
        }
        $userCreated = null;
        $store = function () use ($user, $inputs, &$userCreated) {
            $role = Role::ofUser($user)
                ->findOrFail($inputs['role_id']);

            $userCreated = $role->users()
                ->create($inputs);
        };

        try {
            // Tenta criar o usuário.
            DB::transaction($store);
        } catch (Exception $exception) {
            return apiResponse(500);
        }

        return apiResponse(200, 'Usuário criado com sucesso', [
            'userCreated' => $userCreated
        ]);
    }

    /**
     * Tenta atualizar um usuário.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  int  $id
     * @param  array  $inputs
     * @return stdClass
     */
    public function update(User $user, $id, array $inputs)
    {
        $userToUpdate = User::findOrFail($id);

        if ($user->cant('update', $userToUpdate)) {
            // Permissão negada.
            return apiResponse(403);
        }
        $update = function () use ($user, $inputs, $userToUpdate) {
            $userToUpdate->update($inputs);
        };

        try {
            // Tenta atualizar o usuário.
            DB::transaction($update);
        } catch (Exception $exception) {
            return apiResponse(500);
        }

        return apiResponse(200, 'Usuário atualizado com sucesso');
    }
}
