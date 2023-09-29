<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Truck_subunits;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Trucks extends Model
{
    use HasFactory;

    protected $fillable = [
        'unit_number',
        'year',
        'notes'
    ];

    public function subunit()
    {
        return $this->hasMany(Truck_subunits::class);
    }
}