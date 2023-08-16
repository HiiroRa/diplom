<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Request".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $text_reguest
 * @property string $timestamp
 * @property string|null $text_response
 *
 * @property User $user
 */
class Request extends \yii\db\ActiveRecord
{
    const REQUEST_RESPONSE = 'response';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'timestamp', 'text_request', 'status_request_id'], 'required'],
            [['user_id', 'status_request_id'], 'integer'],
            [['timestamp'], 'safe'],
            [['test_response'], 'required', 'on'=> static::REQUEST_RESPONSE],
            [['title'], 'string', 'max' => 255],
            [['text_request', 'test_response'], 'string', 'max' => 2000],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['status_request_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusRequest::class, 'targetAttribute' => ['status_request_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер запроса',
            'user_id' => 'ФИО пользователя',
            'title' => 'Тема запроса',
            'text_request' => 'Текст запроса',
            'test_response' => 'Текст ответа',
            'status_request_id' => 'Статус запроса',
        ];
    }

    /**
     * Gets query for [[StatusRequest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusRequest()
    {
        return $this->hasOne(StatusRequest::class, ['id' => 'status_request_id']);
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

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->user_id = Yii::$app->user->id;
                $this->status_request_id = StatusRequest::getStatusRequestId('Новый');
                
            }
            return true;
        }
        return false;
    }
}
