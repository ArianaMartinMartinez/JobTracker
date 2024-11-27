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

    public function progresses(): HasMany {
        return $this->hasMany(Progress::class, 'id_offer');
    }

    public function lastestProgress() {
        return $this->hasOne(Progress::class, 'id_offer')->latestOfMany();
    }
}