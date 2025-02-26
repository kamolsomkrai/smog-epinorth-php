<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $hospcode
 * @property string|null $username
 * @property string|null $password
 * @property string|null $hospname
 * @property string|null $office_code
 * @property bool|null $ssj_ok
 * @property string|null $provcode
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ssj_ok'], 'boolean'],
            [['hospcode', 'office_code','provcode'], 'string', 'max' => 5],
            [['username', 'password', 'hospname'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hospcode' => 'Hospcode',
            'username' => 'Username',
            'password' => 'Password',
            'hospname' => 'Hospname',
            'office_code' => 'Office Code',
            'ssj_ok' => 'Ssj Ok',
        ];
    }

    public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.

        return static::find()->where(['id'=>$id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        $model = self::find()->where(['id'=>$token->getClaim('uid')])->one();
        return empty($model) ? null : $model;
        // TODO: Implement findIdentityByAccessToken() method.
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }

    public  static function getUsername($username){
        return static::find()->where(['username'=>$username])->one();

    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

}
