<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Override;

class Portfolio extends Model
{
    protected $guarded = ['id', 'user_id'];
    protected $appends = ['last_updated'];

    #[Override]
    protected static function booted()
    {
        static::deleting(function (Portfolio $pf) {
            if ($pf->resume_path)
                Storage::delete($pf->resume_path);
        });
        return parent::booted();
    }
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getlastUpdatedAttribute(): string
    {
        return $this->updated_at->diffForHumans();
    }
}
