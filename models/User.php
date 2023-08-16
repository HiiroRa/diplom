<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string|null $patronymic
 * @property string $email
 * @property string $login
 * @property string $password
 * @property string $auth_key
 * @property int $role_id
 * @property int|null $group_id
 *
 * @property Group $group
 * @property RequestForm[] $requestForms
 * @property Role $role
 * @property TestingUser[] $testingUsers
 */
class User extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'email', 'login', 'password', 'auth_key', 'role_id'], 'required'],
            [['role_id', 'group_id'], 'integer'],
            [['name', 'surname', 'patronymic', 'email', 'login', 'password', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['login'], 'unique'],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::class, 'targetAttribute' => ['role_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::class, 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'email' => 'Электронная почта',
            'login' => 'Логин',
            'password' => 'Пароль',
            'auth_key' => 'Auth Key',
            'role_id' => 'Роль',
            'group_id' => 'Группа',
        ];
    }

    /**
     * Gets query for [[Group]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::class, ['id' => 'group_id']);
    }

    /**
     * Gets query for [[RequestForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestForms()
    {
        return $this->hasMany(RequestForm::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Role]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * Gets query for [[TestingUsers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTestingUsers()
    {
        return $this->hasMany(TestingUser::className(), ['user_id' => 'id']);
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->security->generatePasswordHash($this->password);
                $this->role_id = Role::getRoleId('user');
            }
            return true;
        }
        return false;
    }

    public static function findByUsername($login)
    {
        return static::findOne(['login' => $login]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->password);
    }

    public function getIsAdmin()
    {
        return $this->role_id == Role::getRoleId('admin');
    }

    public function getIsPsycho()
    {
        return $this->role_id == Role::getRoleId('psychologist');
    }

}
