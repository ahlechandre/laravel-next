<?php

namespace Modules\User\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\User\Entities\Role;

class RolesTableSeeder extends Seeder
{

    /**
     * @var array
     */
    protected $roles = [
        [
            'name' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Role for system administrators',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $seed = function ($role) {
                return Role::create($role);
            };
            array_map($seed, $this->roles);
        });
    }
}
