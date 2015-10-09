<?php

namespace backend\models;


use Yii;
use yii\data\ActiveDataProvider;


/**
 * This is the model class for table "sys_content_gather".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $code
 * @property string $content_ids
 * @property string $tag
 * @property string $name
 * @property string $type
 * @property string $c_date
 * @property string $u_date
 * @property integer $osort
 * @property integer $status
 */
class SysContentGather extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_content_gather';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'code', 'name', 'c_date', 'u_date', 'osort'], 'required'],
            [['site_id', 'osort', 'status'], 'integer'],
            [['c_date', 'u_date'], 'safe'],
            [['code', 'type'], 'string', 'max' => 100],
            [['content_ids', 'tag', 'name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '内容分组ID',
            'site_id' => '站点ID同一站点下的group-code不允许相同',
            'code' => '代号-提供给模版使用',
            'content_ids' => '本集合包含的内容集 英文逗号分割',
            'tag' => '标签，便于运营分类查看',
            'name' => '集合名称',
            'type' => '分组类型：normal',
            'c_date' => '分组创建时间',
            'u_date' => '分组更新时间',
            'osort' => '排序字段-保留字段',
            'status' => '状态1正常-保留字段',
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
		
		/*
        if(!empty($this->tag)){
            $query->andWhere(['like', 'tag', $this->tag]);
        }*/
        return $dataProvider;
    }	

	//根据 集合ID 按分页取出 生成页面所需传递的参数PAGE共有多少
	public function getMaxpageByGatherAndPage($gather_id,$limit = 20){
		$gatherRes = SysContentGather::findOne($gather_id); 
		
		$sql_in = '(' . $gatherRes->content_ids . ')';
		$sql_db = SysContent::tableName();
		
		$sql = 'select count(*) from '  . $sql_db . ' where `status` = 1 and `id` in ' . $sql_in;
		$content_num = SysContent::findBySql($sql)->count();	
	
		$pageMax = 1;
		$pageMax = intval($content_num / $limit) + 1;
		$content_ids = $gatherRes->content_ids;
		
		$retArr = [
					'content_ids' => $content_ids ,
					'pageMax' => $pageMax ,
				  ];
		return $retArr;
	}	
	
	//根据 集合ID 按分页取出 生成页面所需要的数据 list类型批量页面使用
	public function getContentByGatherAndPage($content_ids,$page = 1,$limit = 20){
		$sql_in = '(' . $content_ids . ')';
		$sql_db = SysContent::tableName();
		$sql_limit = (($page - 1) * $limit) . ',' . $limit;
		
		//$sql = 'select count(*) from '  . $sql_db . ' where `status` = 1 and `id` in ' . $sql_in;
		$sql = 'select * from ' . $sql_db . ' where `status` = 1 and `id` in ' . $sql_in . ' limit ' . $sql_limit;

		$contentRes = SysContent::findBySql($sql)->All();
		if(!empty($contentRes)){
			foreach($contentRes as $key=>$val){
				$contentRes[$key] = SysContent::processData($val);
			}
		}
		//debug($contentRes);die;
		return $contentRes;
		
	}	
}
