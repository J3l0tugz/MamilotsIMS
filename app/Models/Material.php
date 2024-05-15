<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Material extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function supplier() : BelongsTo{
        return $this->belongsTo(Supplier::class);
    }
}
