<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work_place extends Model
{
    protected $table = 'work_places';
    use HasFactory;
    protected $fillable = [
        'work_place'
    ];
    public function work_place(): HasMany
    {
        return $this->hasMany(User::class,);
    }
}
