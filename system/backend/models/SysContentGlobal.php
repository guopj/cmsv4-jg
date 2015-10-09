<?php

namespace backend\models;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "sys_content_global".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $code
 * @property string $name
 * @property string $type
 * @property string $val
 * @property string $other
 */
class SysContentGlobal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName(){
        return 'sys_content_global';
    }

    /**
     * @inheritdoc
     */
    public function rules(){
        return [
            [['site_id', 'code', 'name'], 'required'],
            [['site_id'], 'integer'],
            [['other'], 'string'],
            [['code', 'type'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
            [['val'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels(){
        return [
            'id' => '自增唯一ID',
            'site_id' => '站点ID',
            'code' => '代号',
            'name' => '名称说明',
            'type' => '类型：text,select',
            'val' => '数值',
            'other' => '额外其他数据-JSON数组保存',
        ];
    }
	
    /**
     *  @搜索 组建配套搜索
     */
    public function search($params){
        $query = $this->find();
        $query->orderBy('id desc');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'30']
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }
		
		
        if(!empty($this->tag)){
            $query->andWhere(['like', 'tag', $this->tag]);
        }
        return $dataProvider;
    }	

	/**
	 *  
	 */
	public function getList($params){
		$this->find()->where(['name' => '小伙儿'])->one();
	}
	
	/*
		全局内容展示函数
	*/
	public function getContentGlobal(){
		$site_id = CusSystem::getSiteId();
		$res = $this->find()->where(['site_id' => $site_id])->all();
		foreach($res as $key=>$val){
			$res[$key] = $this->processData($val);
		}
		return $res;
		debug($res);
		
	}
	
		/*
		加工数据
		解析 json数据 j_imgs等等
	*/
	public static function processData($res){
		// 解析j_imgs JSON数组
		$retArr = [];
		if(!empty($res->other)){
			$retArr = json_decode($res->other);
		}
		
		$res->other = $retArr;	
		//$contentRes->imgs = $res;		
		return $res;
	}
	
}
