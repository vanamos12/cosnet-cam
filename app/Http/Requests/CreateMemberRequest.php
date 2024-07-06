<?php

namespace App\Http\Requests;

use App\Rules\MoreThanXYears;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class CreateMemberRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'town' => ['required', 'string', 'min:2', 'max:255'],
            'cni_number' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'birthday' => ['required', 'date', new MoreThanXYears],
            'cni_recto' => ['nullable', 'file', File::types(['png', 'jpg', 'webp', 'jpeg', 'gif']), 'max:1024'],
            'cni_verso' => ['nullable', 'file', File::types(['png', 'jpg', 'webp', 'jpeg', 'gif']), 'max:1024']
        ];
    }
}
