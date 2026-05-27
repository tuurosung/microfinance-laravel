<?php

namespace App\Models\Cif;

use App\Services\Cif\IdGenerator;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cif extends Model
{
    use HasUuids;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {

            // uuid for id
            // $model->id = Uuid

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

    protected $fillable = [
        'cif_number',
        'entity_type',
        'first_name',
        'other_names',
        'official_name',
        'phone_number',
        'email',
        'residential_address',
        'date_of_birth',
        'gh_card_number',
        'tax_id',
        'kyc_level',
    ];

    // relationships
    public function kyc(): HasOne
    {
        return $this->hasOne(Kyc::class, 'cif_id', 'cif_id');
    }
}
