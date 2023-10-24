<?php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $roles =array(
            array(
                'id' => 1,
                'name'  =>'Admin',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'id' => 2,
                'name'  =>'Buyer',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'id' => 3,
                'name'  =>'Department',
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
        );
        foreach ($roles as $role) {
            $count = Role::where("id",$role["id"])->count();
            if($count < 1)
            {
                Role::insert($role);
            }
        }
        $users =array(
            array(
                'id' => 1,
                'name'  =>'Admin',
                'role_id' => 1,
                'username' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            array(
                'id' => 2,
                'name'  =>'Buyer',
                'role_id' => 2,
                'username' => 'user',
                'password' => Hash::make('password'),
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ),
            // array(
            //     'id' => 3,
            //     'name'  =>'Department',
            //     'role_id' => 3,
            //     'username' => 'department',
            //     'password' => Hash::make('password'),
            //     'created_at' => now()->toDateTimeString(),
            //     'updated_at' => now()->toDateTimeString()
            // )
        );
        foreach ($users as $user) {
            $count = User::where("username",$user["username"])->count();
            if($count < 1)
            {
                User::insert($user);
            }
        }
    }
}
