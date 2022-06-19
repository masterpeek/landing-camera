<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Helpers\StringGenerator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
			'slug' => (new StringGenerator())->generateSlug(),
            'first_name' => 'Super',
			'last_name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('test555'),
			'created_at' => Carbon::now(),
        ]);
    }
}
