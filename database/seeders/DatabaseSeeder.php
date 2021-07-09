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
            'description' => 'زجاجة مياة البركة',
            'qty' => 10,
            'weight' => 1,
            'price' => 5,
            'merchant_id' => 2
        ]);

        Product::create([
            'name' => 'رزمة ورق A4 فاخر',
            'image' => '/images/barcode-2.jpg',
            'barcode' => '3613630000028',
            'description' => 'A4 80G COPY PAPER, 500 SHEETS PER PACK.',
            'qty' => 100,
            'weight' => 10,
            'price' => 50,
            'merchant_id' => 2
        ]);

        Product::create([
            'name' => 'BLUEBELL MALINDA SKIN CLEANSER GEL - 200 ML',
            'image' => '/images/barcode-3.jpg',
            'barcode' => '6224008235149',
            'description' => 'INNOVATIVE COMPINATION OF PURIFIYING CLEANSING GEL FOR FACE AND BACK AND BODY GENTLY CLEANSES WITHOUT DRYING SKIN. PUIRIFIES AND DEEP CLEANSES PORES EFFECTIVELY ELIMINATES EXCESS SEBUM AND IMPURITIES. HAS KERATOLYTIC ACTION GENTLE SOAP-FREE CLEANSING BASE , PLEASENT FRAGRANCE 200 ML',
            'qty' => 25,
            'weight' => 1,
            'price' => 150,
            'merchant_id' => 2
        ]);

        Product::create([
            'name' => 'جاراميسين - GARAMYCIN',
            'image' => '/images/barcode-4.jpg',
            'barcode' => '6221050130057',
            'description' => 'جنتاميسين هو مضاد حيوي ينتمي إلى مجموعة من الأدوية تعرف باسم أمينوغليكوزيد (بالإنجليزية: Aminoglycoside)، ويستخدم لعلاج العديد من الالتهابات البكتيرية، مثل عدوى العين البكتيرية.',
            'qty' => 250,
            'weight' => 0.25,
            'price' => 30,
            'merchant_id' => 2
        ]);

        Product::create([
            'name' => 'فول امريكانا مدمس 400 جرام',
            'image' => '/images/barcode-5.jpg',
            'barcode' => '032894022011',
            'description' => 'علبة فول امريكانا مدمس',
            'qty' => 1000,
            'weight' => 0.5,
            'price' => 12,
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
