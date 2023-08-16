<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Status_request".
 *
 * @property int $id
 * @property string $title
 *
 * @property Request[] $requests
 */
class StatusRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Status_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::class, ['status_request_id' => 'id']);
    }

    public static function getStatusRequestId($title)
    {
        return static::findOne(['title' => $title])->id;
    }

    public static function getStatusRequestList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }
}
