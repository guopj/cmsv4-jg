<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_log".
 *
 * @property integer $id
 * @property string $realname
 * @property string $msg
 * @property string $data
 * @property string $type
 * @property integer $site_id
 * @property string $addtime
 */
class SysLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['realname', 'msg', 'type', 'addtime'], 'required'],
            [['data'], 'string'],
            [['site_id'], 'integer'],
            [['addtime'], 'safe'],
            [['realname'], 'string', 'max' => 50],
            [['msg'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '日志ID',
            'realname' => '用户',
            'msg' => '信息',
            'data' => '数据',
            'type' => '类型',
            'site_id' => '站点ID',
            'addtime' => '执行时间',
        ];
    }

    /**
     * 记录操作日志
     * $type = ['site','node','recommend','banner','content','album','generate']
     */
    public static function writeLog($msg,$type){
        $data = Yii::$app->getRequest()->post();
        if(isset($data['_csrf'])){
            unset($data['_csrf']);
        }
        $model = new Log();
        $model->realname = Yii::$app->user->getIdentity()->realname;
        $model->site_id = 1;
        $model->msg = $msg;
        $model->data = serialize($data);
        $model->type = $type;
        $model->addtime = date('Y-m-d H:i:s');
        $model->save();
    }
}
