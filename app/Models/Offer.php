<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title', 'description', 'price', 'image_url', 'expiry_date', 'is_active'];

}
