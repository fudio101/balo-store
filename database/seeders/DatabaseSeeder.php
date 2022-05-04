<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_URL') == 'http://localhost') {
            DB::unprepared(file_get_contents('database/migrations/dvhc_mysql.sql'));
        } else {
            DB::unprepared(file_get_contents('database/migrations/dvhcvn.sql'));
        }
        Category::factory(7)->create();
        Product::factory(20)->create();
        Discount::factory(20)->create();
        Order::factory(25)->create();

    }
}
