<?php


namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StorePricingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }



    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $service =  Service::find($this->service_id);
        $this->merge([
            'slug' => Str::slug($this->type) . '-' . $service->slug,

            // 'image' => $this?->image ? $this->image['file_name'] : '',
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'service_id' => ['required'],
            'type' => ['required'],
            'slug' => ['required'],
            'price' => ['required'],
            'items' => ['required', 'array'],
        ];
    }
}