<?php

namespace App\Http\Requests\Socials;

use Illuminate\Foundation\Http\FormRequest;

class SocialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }
    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        return [
            'name' => 'required|string|max:191',
            'contract_name' => 'required|string|max:191',
            'reconduction_name' => 'required|string|max:191',
            'function' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'advance_notice_reconduction' => 'required|string|max:191',
            'start_contract_date' => 'required|date_format:d/m/Y',
            'end_contract_date' => 'required|date_format:d/m/Y',
            'alarm1_date' => 'required|date_format:d/m/Y',
            'alarm2_date' => 'required|date_format:d/m/Y',
            'alarm3_date' => 'required|date_format:d/m/Y',
            'observation' => 'required|string|max:1000',
            'duration' => 'required|numeric',
            // 'photo' => 'sometimes|files',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            //'category_id' => 'required|integer|exists:categories,id',
            'name' => 'required|string|max:191',
            'contract_name' => 'required|string|max:191',
            'reconduction_name' => 'required|string|max:191',
            'function' => 'required|string|max:191',
            'city' => 'required|string|max:191',
            'advance_notice_reconduction' => 'required|string|max:191',
            'start_contract_date' => 'required|string|max:191',
            'end_contract_date' => 'required|string|max:191',
            'alarm1_date' => 'required|string|max:191',
            'alarm2_date' => 'required|string|max:191',
            'alarm3_date' => 'required|string|max:191',
            'observation' => 'required|string|max:1000',
            'duration' => 'required|numeric'
            // 'tags' => 'required|array',
            // 'photo' => 'sometimes|files',
        ];
    }
}
