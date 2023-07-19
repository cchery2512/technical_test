<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParticipantResult extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'result',
        'participant_id',
        'judge_id'
    ];

    public function judge(): BelongsTo
    {
        return $this->belongsTo(User::class, 'judge_id', 'id');
    }

    public function participant(): BelongsTo
    {
        return $this->belongsTo(User::class, 'participant_id', 'id');
    }
}
