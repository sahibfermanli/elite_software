<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\DeletedScope;
use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    //use HasFactory;

    protected $table = 'currencies';

    protected $fillable = [
        'name',
        'icon',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope( new DeletedScope( 'currencies' ) );
    }
}
