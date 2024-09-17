<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerHobbie extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'hobbie_id'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function hobbie(): BelongsTo
    {
        return $this->belongsTo(Hobbie::class);
    }
}
