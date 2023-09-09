<?php

namespace Database\Seeders;

use App\Models\Core\Auth\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class UserRoleTableSeeder.
 */
class UserRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    /**
     * Run the database seed.
     */
    public function run()
    {
        $this->disableForeignKeys();

        $user = User::query()->find(79);
        $user->assignRole(config('access.users.app_admin_role'));
        // manager
        $user = User::query()->find(80);
        $user->assignRole('Manager');
        //agent
        $user = User::query()->find(81);
        $user->assignRole('Agent');
        // $user = User::query()->find(4);
        // $user->assignRole('Client');
        $this->enableForeignKeys();
    }
}
