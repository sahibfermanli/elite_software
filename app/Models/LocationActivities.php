<?php

namespace App\Models;

use App\Scopes\DeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationActivities extends Model
{
//    use HasFactory;

    protected $table = 'location_activities';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope( new DeletedScope( 'location_activities' ) );
    }
}
