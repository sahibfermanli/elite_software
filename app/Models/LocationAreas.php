<?php

namespace App\Models;

use App\Scopes\DeletedScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */

class LocationAreas extends Model
{
    //use HasFactory;

    protected $table = 'location_areas';

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

        static::addGlobalScope( new DeletedScope( 'location_areas' ) );
    }
}
