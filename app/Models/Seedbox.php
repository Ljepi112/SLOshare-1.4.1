<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\Encryptable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seedbox extends Model
{
    use HasFactory;
    use Encryptable;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The Attributes That Are Encrypted.
     */
    protected array $encryptable = [
        'ip',
    ];

    /**
     * Belongs To A User.
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'username' => 'System',
            'id'       => '1',
        ]);
    }
}
