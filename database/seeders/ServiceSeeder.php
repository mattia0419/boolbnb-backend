<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $_services = [

      [
        "label" => "Kitchen",
        "icon" => "fa-solid fa-utensils",
        "id" => "1",
      ],
      [
        "label" => "Wi-fi",
        "icon" => "fa-solid fa-wifi",
        "id" => "2",
      ],
      [
        "label" => "Parking Spot",
        "icon" => "fa-solid fa-car",
        "id" => "3",
      ],
      [
        "label" => "Swimming Pool",
        "icon" => "fa-solid fa-water-ladder",
        "id" => "4",
      ],
      [
        "label" => "Sauna",
        "icon" => "fa-solid fa-bath",
        "id" => "5",
      ],
      [
        "label" => "Sea View",
        "icon" => "fa-solid fa-water",
        "id" => "6",
      ],
    ];
    foreach ($_services as $_service) {
      $service = new Service;
      $service->label = $_service["label"];
      $service->icon = $_service["icon"];
      $service->id = $_service["id"];
      $service->save();
    }
  }
}