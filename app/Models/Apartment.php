<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'visible', 'cover_img','rooms',
    'beds',
    'bathrooms',
    'square_meters',
    'address',
    'longitude',
    'latitude',
    'price',];
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
}