<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();

        Product::factory(50)->create();
        Cart::factory(3)->create()->each(function ($cart) {
            for ($i = 1; $i <= 10; $i++)
                $cart->products()->attach($i);
        });


        //Permissions
        $superAdmin = Role::create(['name' => 'super-admin']);
        Permission::create(['name' => 'administrate']);
        $superAdmin->givePermissionTo('administrate');


        //Sample admin account
        User::create(['name' => 'Abdu',
            'email' => 'aelkayal88@gmail.com',
            'password' => '$2y$10$4AZXlxUgDHqC3Tz/KMXHmehOrBIeAAAPqlVEFTS3wD/jNVV/uLTd2' //123456789
        ])->assignRole('super-admin');
    }
}
