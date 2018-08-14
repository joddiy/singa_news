<?php

namespace app\models;

/**
 * This is the model class for table "{{%lb_user}}".
 *
 * @property int $user_id
 * @property string $user_name
 * @property string $user_password
 * @property string $authKey
 * @property string $user_token
 * @property string $user_email
 * @property int $user_status
 * @property int $user_role
 * @property string $add_time
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%lb_user}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_name', 'user_password', 'authKey', 'user_token'], 'required'],
            [['user_status'], 'integer'],
            [['add_time'], 'safe'],
            [['user_name'], 'string', 'max' => 20],
            [['user_password', 'authKey', 'user_token'], 'string', 'max' => 32],
            [['user_email'], 'string', 'max' => 50],
            [['user_token'], 'unique'],
            [['user_role'], 'in', 'range' => ['admin', 'user', 'visitor']],
            [['user_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['user_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['user_name' => $username]);
    }

    public static function findByUserId($id)
    {
        return static::findOne(['user_id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->user_id;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return $this->user_role === "admin" && $this->user_status === 1;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->user_password === md5($password);
    }

}
