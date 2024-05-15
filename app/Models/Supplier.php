<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function material() : HasMany{
        return $this->hasMany(Material::class);
    }
}
