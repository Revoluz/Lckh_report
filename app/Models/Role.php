<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    protected $table = 'roles';
    use HasFactory;
    protected $fillable = [
        'role',
    ];
    // protected $with = ['user'];
    public function user(): HasMany
    {
        return $this->hasMany(User::class,);
    }
}
