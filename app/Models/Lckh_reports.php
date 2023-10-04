<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lckh_reports extends Model
{
    protected $table = 'lckh_reports';
    use HasFactory;
    protected $fillable = [
        'user_id',
        'upload_document',
        'monthly_report',
        'upload_date',
    ];
    protected $with = ['user'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
