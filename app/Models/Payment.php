<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    /**
     * Make every field fillable.
     */
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
