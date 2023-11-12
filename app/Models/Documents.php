<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Documents extends Model
{
    protected $table = 'documents';
    use HasFactory;
    protected $fillable = [
        'name',
        'filename',
        'user_id',
        'document_type_id',
        'document_date',
    ];
    protected $with = ['user', 'document_type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function document_type(): BelongsTo
    {
        return $this->belongsTo(Document_types::class, 'document_type_id', 'id');
    }
}
