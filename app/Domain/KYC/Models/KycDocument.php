<?php

namespace App\Domain\KYC\Models;

use App\Concerns\HasCheckSum;
use App\Observers\KycDocumentObserver;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

#[ObservedBy([KycDocumentObserver::class])]
#[Fillable(["kyc_id","document_type", "file_path", "mime_type", "file_size_bytes", "check_sum"])]
class KycDocument extends Model
{
    use SoftDeletes;
    use HasCheckSum;


    protected $table = 'kyc_documents';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;


    protected array $checksumColumns = [
        'document_type',
        'file_path',
        'mime_type',
        'file_size_bytes',
    ];


    public function fileUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->file_path) {
                    return Storage::url($this->file_path);
                }
                return null;
            }
        );
    }
}
