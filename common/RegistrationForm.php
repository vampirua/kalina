<?php
/**
 * Created by PhpStorm.
 * User: Dimon
 * Date: 24.05.2018
 * Time: 11:06
 */

namespace app\common;


use yii\base\Model;

class RegistrationForm extends Model
{
    public $username;
    public $password;
    public $email;
    public $phone;


    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'email','phone'], 'required']
        ];
    }



}