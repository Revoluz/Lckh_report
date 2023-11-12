<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_types extends Model
{
    protected $table = 'document_types';

    use HasFactory;
    protected $fillable = [
        'name',
    ];
}
