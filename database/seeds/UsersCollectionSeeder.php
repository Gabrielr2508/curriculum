<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$user = new User;
		$user->name = 'Test';
		$user->email = 'test@test.com';
		$user->password = bcrypt('1234');

		$user->save();
    }
}
