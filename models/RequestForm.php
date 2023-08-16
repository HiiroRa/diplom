<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "Request_form".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $text_request
 * @property string $timestamp
 * @property string|null $text_response
 *
 * @property User $user
 */
class RequestForm extends Model
{

    public $title;
    public $text_request;
    public $timestamp;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'text_request', 'timestamp'], 'required'],
            [['text_request'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Тема обращения',
            'text_request' => 'Текст обращения',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function registerRequest()
    {
        
        if ($this->validate()) {
            $request = new Request();
            if($request->load($this->attributes, '')){
                if(!$request->save(false)){

                }
            }
        }
        return $request ?? false;
    }
}
