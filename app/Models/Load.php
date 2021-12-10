<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Load extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        "id",
        "title",
        "weight"
    ];

    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
