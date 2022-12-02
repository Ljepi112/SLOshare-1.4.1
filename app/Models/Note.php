<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'user_notes';

    /**
     * Belongs To A User.
     */
    public function noteduser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }

    /**
     * Belongs To A User.
     */
    public function staffuser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id')->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }
}
