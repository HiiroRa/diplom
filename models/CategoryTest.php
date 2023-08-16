<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Category_test".
 *
 * @property int $id
 * @property string $title
 *
 * @property Test[] $tests
 */
class CategoryTest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Category_test';
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

            'id' => 'Номер категории',
            'title' => 'Наименование',
        ];
    }

    /**
     * Gets query for [[Tests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::class, ['category_test_id' => 'id']);
    }

    public static function getCategoryTestList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getCategoryTestName($id)
    {
        return static::findOne(['id' => $id])->title;
    }
}
