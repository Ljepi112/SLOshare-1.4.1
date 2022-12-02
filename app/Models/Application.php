<?php

namespace App\Models;

use App\Traits\Auditable;
use Hootlex\Moderation\Moderatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    use Moderatable;
    use Auditable;

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Application Has Been Moderated By.
     */
    public function moderated(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'moderated_by');
    }

    /**
     * A Application Has Many Image Proofs.
     */
    public function imageProofs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ApplicationImageProof::class);
    }

    /**
     * A Application Has Many URL Proofs.
     */
    public function urlProofs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ApplicationUrlProof::class);
    }
}
