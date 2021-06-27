<?php

use App\Models\Customer;
use App\Models\CustomerPhone;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \factory(Customer::class, 10)->create()->each(function($u) {
            $u->phoneNumbers()->saveMany(factory(CustomerPhone::class, 2)->make());
        });
    }
}
