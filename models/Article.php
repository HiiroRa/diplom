<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Article".
 *
 * @property int $id
 * @property int $category_article_id
 * @property int $user_id
 * @property string $title
 * @property string $img
 * @property string $description
 * @property string $text
 * @property string $timestamp
 *
 * @property CategoryArticle $categoryArticle
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_article_id', 'user_id', 'title', 'description', 'content', 'timestamp'], 'required'],
            [['category_article_id', 'user_id'], 'integer'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg'],
            [['timestamp'], 'safe'],
            [['title', 'img'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500],
            [['content'], 'string', 'max' => 10000],
            [['category_article_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryArticle::class, 'targetAttribute' => ['category_article_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер статьи',
            'category_article_id' => 'Категория',
            'user_id' => 'Пользователь',
            'title' => 'Название',
            'img' => 'Изображение',
            'imageFile' => 'Изображение',
            'description' => 'Описание',
            'content' => 'Наполнение',
            'timestamp' => 'Время создания',
        ];
    }

    /**
     * Gets query for [[CategoryArticle]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryArticle()
    {
        return $this->hasOne(CategoryArticle::class, ['id' => 'category_article_id']);
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


    public function upload()
    {
        if ($this->validate()) {
            $fileName = '/web/img/blog/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs(Yii::getAlias('@app') . $fileName);
            $this->img = $fileName;
            return true;
        } else {
            return false;
        }
    }

    public static function getArticleName($id)
    {
        return static::findOne(['id' => $id])->title;
    }

}
