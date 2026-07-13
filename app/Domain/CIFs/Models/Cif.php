<?php

namespace App\Domain\CIFs\Models;

use App\Concerns\HasCheckSum;
use App\Concerns\System\Lockable;
use App\Domain\KYC\Models\Kyc;
use App\Enums\Cif\SexOptions;
use App\Observers\CifObserver;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


#[ObservedBy([CifObserver::class])]
#[Fillable(["cif_number", "entity_type", "first_name", "other_names", "official_name", "phone_number", "email", "residential_address", "date_of_birth", "sex", "marital_status"])]
class Cif extends Model
{
    use HasUuids;
    use Lockable;
    use SoftDeletes;
    use HasCheckSum;


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


    protected array $checksumColumns = [
        'entity_type',
        'first_name',
        'other_names',
        'official_name',
        'phone_number',
        'email',
        'residential_address',
        'date_of_birth',
        'sex',
    ];


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


    public function resolveRouteBinding($value, $field = null)
    {
        $cif = $this->where($field ?? $this->getRouteKeyName(), $value)->firstOrFail();
        $kyc = $cif->kyc()->firstOrCreate([]);
        $cif->setRelation('kyc', $kyc);
        return $cif;
    }
}
