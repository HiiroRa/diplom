<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Test".
 *
 * @property int $id
 * @property string $title
 * @property int $category_test_id
 *
 * @property CategoryTest $categoryTest
 * @property Question[] $questions
 * @property TestingUser[] $testingUsers
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Test';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'category_test_id'], 'required'],
            [['category_test_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['category_test_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryTest::class, 'targetAttribute' => ['category_test_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'category_test_id' => 'Категория теста',
        ];
    }

    /**
     * Gets query for [[CategoryTest]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryTest()
    {
        return $this->hasOne(CategoryTest::class, ['id' => 'category_test_id']);
    }

    /**
     * Gets query for [[Questions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::class, ['test_id' => 'id']);
    }

    /**
     * Gets query for [[TestingUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestingUsers()
    {
        return $this->hasMany(TestingUser::class, ['test_id' => 'id']);
    }

    public static function getTestList()
    {
        return static::find()->select(['title'])->indexBy('id')->column();
    }

    public static function getQuestionsTest($id)
    {
        //return static::find()->joinWith('questions')->where(['test_id'=>$id])->asArray()->all();

        return Question::find()->where(['test_id'=> $id])->asArray()->all();
    }


    public static function getQuestionsCount($id)
    {
        //return static::find()->joinWith('questions')->where(['test_id'=>$id])->asArray()->all();

        return Question::find()->where(['test_id'=> $id])->count();
    }

    public static function getTestName($id)
    {
        return static::findOne(['id' => $id])->title;
    }

    public static function getTestId($title)
    {
        return static::findOne(['title' => $title])->id;
    }

    public function getCategoryQuestions()
    {
        return $this->hasMany(CategoryQuestion::class, ['test_id' => 'id']);
    }
    
}
