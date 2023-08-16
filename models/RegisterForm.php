<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class RegisterForm extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $login;
    public $password;
    public $password_repeat;
    public $group_id;
    public $rules;
    


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'login', 'password', 'password_repeat', 'group_id', 'rules'], 'required'],
            [['name', 'surname', 'patronymic', 'email', 'login', 'password', 'password_repeat'], 'string', 'max' => 255],
            [['password', 'password_repeat'], 'string', 'min' => 6],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            ['email', 'email'],
            [['name', 'surname', 'patronymic'], 'match', 'pattern' => '/^[а-яА-ЯёЁ\-\s]+$/u','message' => 'Разрешеные символы: кириллица, пробел и тире'],
            ['login', 'match', 'pattern' => '/^[a-zA-Z0-9\-]+$/','message' => 'Разрешеные символы: латинница, цифры и тире'],
            [['login', 'email'], 'unique', 'targetClass' => User::class],
            [['group_id'], 'integer'],
            [['rules'], 'required', 'requiredValue' => 1, 'message' => 'Согласитесь на обработку персональных данных' ],
        ];
    }


    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Электронная почта',
            'login' => 'Логин',
            'password' => 'Пароль',
            'password_repeat' => 'Повтор пароля',
            'group_id' => 'Номер группы',
            'rules' => 'Согласие на обработку персональных данных',
        ];
    }


    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function registerUser()
    {
        if ($this->validate()) {
            $user = new User();
            if($user->load($this->attributes, '')){
                if(!$user->save(false)){

                }
            }
        }
        return $user ?? false;
    }
}