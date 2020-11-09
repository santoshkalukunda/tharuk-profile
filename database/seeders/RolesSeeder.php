<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create role
        foreach (config('authorization.roles') as $role) {
            $this->command->getOutput()->write("<comment>Creating role: </comment>");
            $this->command->getOutput()->writeln($role);
            ${$role} = Role::firstOrCreate(['name' => $role]);
        }

        // create users and assign roles
        $this->command->comment("<comment>+----------------+</comment>");
        $this->command->comment("| Creating Users |");
        $this->command->comment("<comment>+----------------+</comment>");
        $headers = ['name', 'email', 'password', 'role'];

        $content = [];

        foreach (config('authorization.users') as $user) {
            $newUser = User::whereEmail($user['email'])->first() ??  new User();

            // hash the password
            $user['password'] = bcrypt($user['password']);

            // Get user array without role
            $userExceptRole = $user;
            unset($userExceptRole['role']);

            // Save or update user
            if ($newUser->exists) {
                $newUser->update($userExceptRole);
                $action = 'updated';
            } else {
                $newUser->create($userExceptRole);
                $action = 'created';
            }

            // Assign role to user
            $role = Role::whereName($user['role'])->get();
            $newUser->syncRoles([$role]);

            // Push user to console table
            array_push($content, [$user['first_name'] . ' ' . $user['last_name'], $user['email'], $user['password'], $user['role'], $action]);
        }

        $this->command->table($headers, $content);
    }
}
