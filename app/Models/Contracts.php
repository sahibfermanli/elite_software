<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Scopes\DeletedScope;
use Illuminate\Database\Eloquent\Model;

class Contracts extends Model
{
    //use HasFactory;

    protected $table = 'contracts';

    protected $fillable = [
        'name',
        'payment_type_id',
        'payment_percent', // nullable
        'payment_price', // nullable, with a penny (price/100)
        'currency_id', // nullable
        'is_active',
        'start_date',
        'expiry_date',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::addGlobalScope( new DeletedScope( 'contracts' ) );
    }
}
