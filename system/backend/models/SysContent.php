<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "sys_content".
 *
 * @property integer $id
 * @property integer $site_id
 * @property integer $content_group_id
 * @property string $title
 * @property string $title_sub
 * @property string $img
 * @property string $content
 * @property string $url
 * @property string $other
 */
class SysContent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_content';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'title'], 'required'],
            [['site_id', 'content_group_id', 'ext_model_id'], 'integer'],
            [['content', 'j_imgs', 'j_other'], 'string'],
            [['content_gather_ids', 'title', 'title_sub'], 'string', 'max' => 255],
            [['tag'], 'string', 'max' => 500],
            [['url'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '内容ID',
            'site_id' => '站点ID',
            'content_group_id' => '分组ID 默认0不加入任何分组',
            'content_gather_ids' => '哪些合集用到了该分组',
            'title' => '内容主标题',
            'title_sub' => '文章副标题',
            'tag' => '标签标识 逗号分割',
            'content' => '编辑器编辑内容',
            'url' => '内容详情 url',
            'ext_model_id' => '扩展模型ID 主要记录json两字段的格式',
            'imgs' => '',
			'j_imgs' => '内容图片扩展 JSON',
            'j_other' => '内容其他扩展 JSON',
        ];
    }
	
    /**
     * 
     */
    public function search($params)
    {
		$site_id = CusSystem::getSiteId();
		
        $query = $this->find();
        $query->orderBy('id desc');
		$query->andWhere(['=', 'site_id', $site_id]);
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


	/*
		加工数据
		解析 json数据 j_imgs等等
	*/
	public static function processData($contentRes){
		
		// 解析j_imgs JSON数组
		if(!empty($contentRes->imgs)){
			$tempArr = json_decode($contentRes->imgs);
			$res = [];
			foreach($tempArr as $key=>$val){
				$index = $val->code;
				$res[$index] = $val;
			}
		}
		
		$contentRes->imgs = $res;	
		//$contentRes->imgs = $res;		
		return $contentRes;
	}
	
}
