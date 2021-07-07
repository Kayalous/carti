<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
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
        //Permissions

        //Admin roles and permissions
        $superAdmin = Role::create(['name' => 'super-admin']);
        Permission::create(['name' => 'administrate']);
        $superAdmin->givePermissionTo('administrate');


        //Merchant Roles and permissions
        $merchant = Role::create(['name' => 'merchant']);
        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        $merchant->givePermissionTo([
            'add product',
            'edit product',
            'delete product'
        ]);

        //Cashier Roles and permissions
        $cashier = Role::create(['name' => 'cashier']);
        Permission::create(['name' => 'checkout others']);
        $cashier->givePermissionTo([
            'checkout others'
        ]);

        //Sample admin account
        User::create(['name' => 'Abdu',
            'email' => 'aelkayal88@gmail.com',
            'password' => '$2y$10$4AZXlxUgDHqC3Tz/KMXHmehOrBIeAAAPqlVEFTS3wD/jNVV/uLTd2' //123456789
        ])->assignRole('super-admin');

        //Sample merchant account
        User::create(['name' => 'Abdu',
            'email' => 'aelkayal98@gmail.com',
            'password' => '$2y$10$4AZXlxUgDHqC3Tz/KMXHmehOrBIeAAAPqlVEFTS3wD/jNVV/uLTd2' //123456789
        ])->assignRole('merchant');

        //Sample cashier account
        User::create(['name' => 'Abdu',
            'email' => 'aelkayal99@gmail.com',
            'password' => '$2y$10$4AZXlxUgDHqC3Tz/KMXHmehOrBIeAAAPqlVEFTS3wD/jNVV/uLTd2' //123456789
        ])->assignRole('cashier');

        //Sample categories, products, and carts
        Category::factory(10)->create();
        Product::factory(50)->create()->each(function ($product) {

            $category = rand(1, 10);

            $product->categories()->attach($category);

            $user = User::first();

            $faker = Factory::create();

            $product->makeReview($user, $faker->numberBetween(1, 5), $faker->paragraph);

        });


        Cart::factory(3)->create()->each(function ($cart) {
            for ($i = 1; $i <= 10; $i++)
                $cart->products()->attach($i);

        });

        //Barcode examples
        Product::create([
            'name' => 'زجاجة مياة البركة',
            'image' => '/images/barcode-1.jpg',
            'barcode' => '6223001930082',
            'description' => 'Strictly for my Gamalawys',
            'qty' => 10,
            'weight' => 1,
            'price' => 5,
            'merchant_id' => 2
        ]);

        Product::create([
            'name' => 'رزمة ورق A4 فاخر',
            'image' => '/images/barcode-2.jpg',
            'barcode' => '3613630000028',
            'description' => 'Strictly for my Gamalawys',
            'qty' => 100,
            'weight' => 10,
            'price' => 50,
            'merchant_id' => 2
        ]);


        //Sample user account
        User::create(['name' => 'Abdu',
            'email' => 'abdulrhmanelkayal88@gmail.com',
            'password' => '$2y$10$4AZXlxUgDHqC3Tz/KMXHmehOrBIeAAAPqlVEFTS3wD/jNVV/uLTd2' //123456789
        ])->carts()->sync([1]);

        //Refresh Algolia database
        Artisan::call('scout:flush ' . "App\\\Models\\\Product");

        Artisan::call('scout:import ' . "App\\\Models\\\Product");

    }
}
