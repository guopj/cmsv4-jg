<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "sys_user".
 *
 * @property integer $id
 * @property string $username
 * @property string $realname
 * @property integer $role
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property integer $confirmed_at
 * @property string $unconfirmed_email
 * @property integer $blocked_at
 * @property string $registration_ip
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $flags
 * @property integer $status
 * @property integer $current_site
 * @property string $allow_sites
 *
 * @property SysProfile $sysProfile
 * @property SysSocialAccount[] $sysSocialAccounts
 * @property SysToken[] $sysTokens
 */
class SysUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['role', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags', 'status', 'current_site'], 'integer'],
            [['username'], 'string', 'max' => 25],
            [['realname'], 'string', 'max' => 50],
            [['email', 'unconfirmed_email', 'allow_sites'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['username'], 'unique'],
            [['email'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'realname' => 'Realname',
            'role' => 'Role',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
            'status' => 'Status',
            'current_site' => 'Current Site',
            'allow_sites' => 'Allow Sites',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysProfile()
    {
        return $this->hasOne(SysProfile::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysSocialAccounts()
    {
        return $this->hasMany(SysSocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysTokens()
    {
        return $this->hasMany(SysToken::className(), ['user_id' => 'id']);
    }



    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function getUser($params){

        $query = SysUser:: find();
        $query = $query->orderBy('id desc');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'30']
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }

        if(!empty($this->username)){
            $query->andWhere(['like', 'username', $this->username]);
        }

        if(!empty($this->realname)){
            $query->andWhere(['like', 'realname', $this->realname]);
        }

        if(!empty($this->role)){
            $query->andWhere(['like', 'role', $this->role]);
        }

        return $dataProvider;

    }
}