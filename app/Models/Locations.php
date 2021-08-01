<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\DeletedScope;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    //use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name',
        'area_id',
        'activity_id',
        'contract_id', // nullable
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope( new DeletedScope( 'locations' ) );
    }
}
