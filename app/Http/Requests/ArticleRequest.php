<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Http\Request as IncomingRequest;

class ArticleRequest extends Request
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
            'title'         => 'required',
            'body'          => 'required',
            'published_at'  => 'required|date',
            'slug'          => 'required|unique:articles'
        ];

        if($request->isMethod('PUT'))
        {
            $rules['slug'] = 'required|unique:articles,slug,' . $request->id;
        }
        return $rules;
    }
}
