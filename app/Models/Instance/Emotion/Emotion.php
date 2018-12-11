<?php

namespace App\Models\Instance\Emotion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * An emotion (ex: Adoration) is defined into 3 categories:
 * - Primary: Love
 * - Secondary: Affection
 * - Tertiary: Adoration.
 */
class Emotion extends Model
{
    protected $table = 'emotions';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get the primary emotion record associated with the emotion.
     *
     * @return BelongsTo
     */
    public function primary()
    {
        return $this->belongsTo(PrimaryEmotion::class, 'emotion_primary_id');
    }

    /**
     * Get the secondary emotion record associated with the emotion.
     *
     * @return BelongsTo
     */
    public function secondary()
    {
        return $this->belongsTo(SecondaryEmotion::class, 'emotion_secondary_id');
    }

    /**
     * Get the call records associated with the call.
     *
     * @return BelongsToMany
     */
    public function calls()
    {
        return $this->belongsToMany(Call::class, 'emotion_call')
            ->withPivot('account_id', 'contact_id')
            ->withTimestamps();
    }
}