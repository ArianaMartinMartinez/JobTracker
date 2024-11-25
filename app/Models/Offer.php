<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'company',
        'url',
        'status',
    ];

    public function progress(): HasMany {
        return $this->hasMany(Progress::class);
    }
}
