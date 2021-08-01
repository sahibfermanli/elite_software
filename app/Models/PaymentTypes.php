<?php

namespace App\Models;

use App\Scopes\DeletedScope;
//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTypes extends Model
{
    //use HasFactory;

    protected $table = 'payment_types';

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

        static::addGlobalScope( new DeletedScope( 'payment_types' ) );
    }
}
