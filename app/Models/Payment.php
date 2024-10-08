<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

use App\Models\Scopes\OrganizationScope;

#[ScopedBy([OrganizationScope::class])]
class Payment extends Model
{
    use HasFactory, HasUuids;

    /**
     * Make every field fillable.
     */
    protected $guarded = [];

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
