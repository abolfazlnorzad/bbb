<?php

namespace Nrz\Meeting\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Nrz\Meeting\Traits\ApiResponse;

class MeetingRequest extends FormRequest
{
    use ApiResponse;
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
        return [
            "meetingID"=>["string" , "required","min:3" , "max:255",Rule::unique("meetings" , "meetingID")],
            "meetingName"=>["string" , "required","max:256"],
            "moderatorPW"=>["string" , "required","min:8"],
            "attendeePW"=>["string" , "required","min:3"],
            "fullName"=>["string" , "nullable","max:255"],
            "welcome"=>["string" , "nullable","max:255"],
            "logoutURL"=>["string" , "nullable" ,"url"],
            "duration"=>["string" , "nullable"],
        ];
    }


    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->errorResponse($validator->errors(),422));
    }
}
