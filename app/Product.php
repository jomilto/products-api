<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Utils\CanBeRated;

class Product extends Model
{
    //
    use CanBeRated;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class);
    }
}
