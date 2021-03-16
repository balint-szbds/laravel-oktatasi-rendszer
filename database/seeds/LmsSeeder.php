<?php

use Illuminate\Database\Seeder;

class LmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        DB::table('users')->insert(
            array(
                'id' => 1,
                'name' => "Peti",
                'email'=> "peti@sanyi.hu",
                'password' => "\$2y\$10\$DQRAJdK10Y6Ksa1.aLa84OrWHV2MSMKTCkWV1WhpnD/07LoVJRduu",
                'foglalkozas' => "diak"
            )
        );

        DB::table('users')->insert(
            array(
                'id' => 2,
                'name' => "Kati",
                'email'=> "kati@freemail.hu",
                'password' => "\$2y\$10\$U2T4b71YIdPsGZU8VhVdVOmGc8PWDERnDKoxehU.zbanaOVM1q9Mm",
                'foglalkozas' => "tanar"
            )
        );

        DB::table('users')->insert(
            array(
                'id' => 3,
                'name' => "Ede",
                'email'=> "ede@bede.eu",
                'password' => "\$2y\$10\$mLDko7Q9TCSXkef9rEMVXedpbqiREkoIAev4394dwEYs/cW8RowSC",
                'foglalkozas' => "diak"
            )
        );
    }
}
