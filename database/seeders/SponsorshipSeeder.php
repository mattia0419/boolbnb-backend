<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $_sponsorships = [
            [
                "label" => "Basic",
                "price" => 2.99,
                "duration" => 24
            ],
            [
                "label" => "Gold",
                "price" => 5.99,
                "duration" => 72
            ],
            [
                "label" => "Platinum",
                "price" => 9.99,
                "duration" => 144
            ],
        ];
        foreach ($_sponsorships as $_sponsorship) {
            $sponsorship = new Sponsorship;
            $sponsorship->label = $_sponsorship['label'];
            $sponsorship->price = $_sponsorship['price'];
            $sponsorship->duration = $_sponsorship['duration'];
            $sponsorship->save();
        }
    }
}