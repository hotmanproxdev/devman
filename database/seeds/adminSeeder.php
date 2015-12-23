<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prosystem_administrator')->insert([
            [
                'ccode'=>'devSde',
                'username' => 'troyya',
                'password' =>'7ada520f7fb0eb935a11f392511fe86e',
                'ccode'=>'devSde',
                'fullname' =>'Ali Gurbuz',
                'created_at'=>time(),
                'updated_at'=>time(),
                'photo'=>'aligurbuz512.jpg',
                'extra_info'=>'',
                'lang'=>'1',
                'user_lock'=>'1',
                'role'=>''
            ]
        ]);
    }

}
