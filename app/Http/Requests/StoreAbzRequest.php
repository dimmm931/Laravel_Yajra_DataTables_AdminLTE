<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreAbzRequest extends FormRequest
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
        $RegExp_Phone = '/^[+]380[\d]{1,4}[0-9]+$/'; //phone regexp

        return [
            'first_name'  => ['required', 'string', 'min:3'], 
			'email'       => ['required', 'email'], 
			'user_dob'    => ['required', 'date'], //date validation
			'user_phone'  => ['required',  "regex: $RegExp_Phone" ],
			'user_n'      => ['required', 'string', 'min:3'],
			'user_salary' => ['required',  'numeric'], //numeric to accept float
			'user_rank'   => ['required', 'integer', ],
			'user_superior'   => ['required', 'integer', ],
			'user_hired_at'   => ['required', 'date'], //date validation
			'image' => ['required',  'mimes:png,jpg', 'max:5120' ], //2mb = 2048 //'mimes:jpeg,png,jpg,gif,svg'
        ];
    }
    
    
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
		
		
        // use trans instead on Lang 
        return [
           //'username.required' => Lang::get('userpasschange.usernamerequired'),
	       'first_name.required' => 'We need u to specify the first name',
		   'image.image' => 'Make sure it is an image',
		   'image.mimes' => 'Must be .jpeg, .png, .jpg, .gif, .svg file. Max size is 2048',
		   'image.max' => 'Sorry! Maximum allowed size for an image is 5MB',
		];
	}
    
    
    /**
     * Return validation errors 
     *
     * @param Validator $validator
     */
    /* 
    public function withValidator(Validator $validator)
    {
	    if ($validator->fails()) {
            //return redirect('/admin-add-product')->withInput()->with('flashMessageFailX', 'Validation Failed!!!' )->withErrors($validator);
            //return response()->json(['errors' => $validator->errors()->all()]);
            return response()->json(['errors' => 'fgfgf']);

        }
	}
    */
    
     /**
     * To customize validation response
     *
     * 
     */
    /* 
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new \Illuminate\Http\JsonResponse([
             'errors' => $validator->errors(),
             'data' => [], 
             'meta' => [
                'message' => 'The given data is invalid', 
                'errors' => $validator->errors()
             ]], 422); //422
        //return $response;
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
    */
}
