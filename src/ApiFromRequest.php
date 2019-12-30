<?php


namespace Zngue\Helper;


use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ApiFromRequest extends FormRequest
{
    public function authorize(){
        return true;
    }
    public function rules(){
        return [];
    }
    public function messages(){
        return [];
    }
    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors()->first();
        $this->returnArray($message,422);
        exit();
    }
    public function returnArray($message = 'success', $code = 200 )
    {
        $res = [
            'data'=>[],
            'statusCode' => $code,
            'message' => $message,

        ];
        header('Content-type: text/json');
        echo json_encode($res);
    }
}
