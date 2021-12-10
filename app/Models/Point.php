<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Point extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        "id",
        "name",
        "load_id"
    ];

    protected $dates = [
        'date'
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'd.m';

    protected $casts = [
        'date' => 'datetime:d.m'
    ];

    public function loads()
    {
        return $this->belongsTo(Load::class);
    }

}
