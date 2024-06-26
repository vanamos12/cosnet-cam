<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class SignUpStep2Request extends FormRequest
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
            'membershipid' => ['nullable', 'string', 'max:50'],
            'code' => ['required', 'numeric', 'max:999999', 'min:100000'],
            'cosnetmember' => [Rule::in(['cosnetmember', 'notcosnetmember'])]
        ];
    }

    public function after():array{
        return [
            function (Validator $validator){
                $codeReceived = $this->code;
                $code = session('code');

                if ($code !== $codeReceived){
                    $validator->errors()->add('code', 'The code received is not correct');
                }
            }, 
            function (Validator $validator){
                $membershipid = trim($this->membershipid);

                if ((!$membershipid || $membershipid == '')
                    && 
                    $this->cosnetmember == 'cosnetmember'){
                    $validator->errors()->add('membershipid', 'Please Enter a valid Membership Id');
                }
            }
        ];
    }
}
