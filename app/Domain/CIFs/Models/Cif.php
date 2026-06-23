<?php

namespace App\Domain\CIFs\Models;

use App\Concerns\System\Lockable;
use App\Domain\CIFs\Services\IdGenerator;
use App\Domain\KYC\Models\Kyc;
use App\Enums\Cif\SexOptions;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Override;

#[Fillable(["cif_number", "entity_type", "first_name", "other_names", "official_name", "phone_number", "email", "residential_address", "date_of_birth", "sex", "gh_card_number", "tax_id", "kyc_level"])]
class Cif extends Model
{
    use HasUuids;
    use Lockable;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            $idGenerator = new IdGenerator();
            $model->cif_number = $idGenerator->generate();
            $model->maker_id = auth()->user()->id;

            // if official name is not provided, use first name and other names
            if (!$model->official_name) {
                $model->official_name = $model->first_name . ' ' . $model->other_names;
            }
        });
    }

    protected $table = 'cifs';
    protected $primaryKey = 'cif_id';
    protected $keyType = 'uuid';
    public $incrementing = false;


    protected function casts(): array
    {
        return [
            'created_at'=> 'datetime',
            'sex' => SexOptions::class
        ];
    }


    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->first_name . ' ' . $this->other_names
        );
    }

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn () => \Carbon\Carbon::parse($this->date_of_birth)->age
        );
    }



    // relationships
    public function kyc(): HasOne
    {
        return $this->hasOne(Kyc::class, 'cif_id', 'cif_id');
    }


    #[Override]
    public function resolveRouteBinding($value, $field = null)
    {
        $cif = $this->where($field ?? $this->getRouteKeyName(), $value)->firstOrFail();
        $kyc = $cif->kyc()->firstOrCreate([]);
        $cif->setRelation('kyc', $kyc);
        return $cif;
    }
}
