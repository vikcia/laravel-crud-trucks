<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck_subunits extends Model
{
    use HasFactory;

    protected $fillable = [
        'trucks_id',
        'main_truck',
        'subunit',
        'start_date',
        'end_date'
    ];
    public function truck()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        // return $this->belongsTo(Trucks::class,'trucks_id','id');
        return $this->hasMany(Trucks::class,'trucks_id')->orderBy('id','desc');
    }
}
