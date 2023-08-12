<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //create default user
        $check_user = User::where( 'email', 'mdf41401@gmail.com' )->first();
        $check_user = User::where( 'email', 'ft@gmail.com' )->first();
        if ( $check_user == null ) {
            $create_user           = new User;
            $create_user->name     = "Faisal Tamim";
            $create_user->email    = "mdf41401@gmail.com";
            $create_user->password = Hash::make( '12345678' );
            $create_user->save();

        } else if ( $check_user == null ) {
            $create_user           = new User;
            $create_user->name     = "Faisal Tamim";
            $create_user->email    = "ft@gmail.com";
            $create_user->password = Hash::make( '12345678' );
            $create_user->save();
        } else {

        }

    }
}
