<?php

namespace App\Models;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Apartment extends Model {
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
        'price',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function messages() {
        return $this->hasMany(Message::class);
    }
    public function services() {
        return $this->belongsToMany(Service::class);
    }
    public function sponsorships() {
        return $this->belongsToMany(Sponsorship::class);
    }
    public function getUrlImag() {
        return $this->cover_img = Storage::url($this->cover_img);
    }
}