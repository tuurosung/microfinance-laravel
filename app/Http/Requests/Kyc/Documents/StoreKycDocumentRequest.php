<?php

namespace App\Http\Requests\Kyc\Documents;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class StoreKycDocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {

        $type = $this->input('document_type');

        return array_merge(
            $this->baseRules(),
            $this->rulesFor($type)
        );
    }


    // Rules for all documents submitted
    private function baseRules(): array
    {
        return [
            'document_type' => ['required', 'string', 'in:ghana_card_photo_file,passport_photo_file'],
            // 'document_label' => ['required_if: document_type, other', 'nullable', 'string', 'max:100']
        ];
    }


    private function rulesFor(string $type): array
    {
        // dd($type);
        return match ($type) {

            'ghana_card_photo_file' => [

                'ghana_card_photo' => [
                    'required',
                    'image',
                    'mimes:jpg, jpeg, png',
                    'max: 2048',
                ]
            ],

            'passport_photo_file' => [
                'passport_photo' => [
                'required',
                'image',
                'mimes:jpg, jpeg, png',
                'max: 2048',
                ]
            ],
        };
    }


    // Upload images to storage and generate paths after validation
    protected function passedValidation(): void
    {
        // Handle the ghana card photo
        if ($this->hasFile('ghana_card_photo')) {
            $this->file_path = $this->file('ghana_card_photo')->store('ghana_card_photos', 'public');
            $this->document_type = 'ghana_card_photo';
            $this->mime_type = $this->file('ghana_card_photo')->getMimeType();
            $this->file_size = $this->file('ghana_card_photo')->getSize();
            $this->check_sum = hash_file('sha256', $this->file('ghana_card_photo')->getRealPath());

        }

        // Handle the passport photo
        if ($this->hasFile('passport_photo')) {
            $this->file_path = $this->file('passport_photo')->store('passport_photos', 'public');
            $this->document_type = 'passport_photo';
            $this->mime_type = $this->file('passport_photo')->getMimeType();
            $this->file_size = $this->file('passport_photo')->getSize();
            $this->check_sum = hash_file('sha256', $this->file('passport_photo')->getRealPath());
        }
    }


    public function validatedDocumentData($key = null, $default = null): array
    {
        $validated = parent::validated();

        // return $validated;

        // Arr::forget($validated, ['ghana_card_photo', 'passport_photo']);

        return array_merge($validated, [
            'file_path' => $this->file_path,
            'document_type' => $this->document_type,
            'mime_type' => $this->mime_type,
            'file_size_bytes' => $this->file_size,
            'checksum' => $this->check_sum
        ]);
    }

}
