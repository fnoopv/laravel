<?php
/**
 * Created by PhpStorm.
 * User: sunhao
 * Date: 2018/3/29
 * Time: 13:08
 */

namespace App\Http\Requests;


class StoreTopicRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'body' => 'required',
        ];
    }
}