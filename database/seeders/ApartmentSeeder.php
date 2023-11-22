<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users_ids = User::all()->pluck('id');

        $apartment = new Apartment();
        $apartment->title = "test";
        $apartment->cover_img = "test";
        $apartment->user_id = $users_ids[0];
        $apartment->save();
    }
}