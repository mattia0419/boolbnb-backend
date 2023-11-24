<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'title',
        'visible',
        'cover_img',
        'rooms',
        'beds',
        'bathrooms',
        'square_meters',
        'address',
        'longitude',
        'latitude',
        'price',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    // public static function getCoordinatesFromAddress(string $address)
    // {
    //     $client = new Client();
    //     $_address = urlencode($address);

    //     $response = $client->get('https://api.tomtom.com/search/2/geocode/' . $_address . '.json', [
    //         'query' => [
    //             'key' => 'EoW1gArKxlBBEKl68AZm1uhfhcLougV4',
    //         ],
    //     ]);
    //     error_log(print_r($response, true));
    //     $data = json_decode($response->getBody(), true);
    //     $latitude = $data['results'][0]['position']['lat'];
    //     $longitude = $data['results'][0]['position']['lon'];
    //     return compact('latitude', 'longitude');
    // }
}