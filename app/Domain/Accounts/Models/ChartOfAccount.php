<?php

declare(strict_types= 1);

namespace App\Domain\Accounts\Models;

use App\Enums\Accounts\GlTypeEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(["code","name", "type", "parent_id", "is_system", "is_posting"])]
class ChartOfAccount extends Model
{

    protected function casts(): array
    {
        return [
            'is_system'  => 'boolean',
            'is_posting' => 'boolean',
            'type' => GlTypeEnum::class
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'gl_account_id');
    }
}
