<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\Request as IncomingRequest;

class SettingsRequest extends Request
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
    public function rules(IncomingRequest $request)
    {
        $rules = [
            'blog_name'                 => 'required',
            'tagline'                   => 'required',
            'featured_image'            => 'required'
        ];

        return $rules;
    }
}
