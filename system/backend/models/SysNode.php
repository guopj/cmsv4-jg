<?php

namespace backend\models;

use Yii;
//use yii\data\ActiveDataProvider;			原来用的
use yii\data\Pagination;					

use backend\models\CusSystem;
use backend\models\SysContentGroup;			//使用 内容组类
use backend\models\SysContentArticle;


/**
 * This is the model class for table "sys_node".
 *
 * @property integer $id
 * @property integer $site_id
 * @property string $code
 * @property string $name
 * @property integer $type
 * @property integer $client
 * @property integer $parent_id
 * @property string $filedir
 * @property string $filename
 * @property string $url
 * @property string $tpl_type
 * @property string $tpl_url
 * @property string $others
 * @property string $node_code
 * @property integer $status
 */
class SysNode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_node';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_id', 'code', 'name', 'parent_id', 'filedir', 'filename', 'url'], 'required'],
            [['site_id', 'client', 'parent_id', 'status'], 'integer'],
            [['others'], 'string'],
            [['code', 'type'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 32],
            [['filedir', 'url', 'tpl_type', 'tpl_url'], 'string', 'max' => 255],
            [['filename'], 'string', 'max' => 36],
            [['content_group_ids'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '节点ID',
            'site_id' => '站点ID,绑定具体站点',
            'code' => '节点名称代号(暂时没用)',
            'name' => '节点名称(用于方便查看)',
            'type' => '类型：normal,detail,list',
            'client' => '1:PC页面 2:手机',
            'parent_id' => '父节点ID',
            'filedir' => '节点目录',
            'filename' => '节点文件名',
            'url' => '节点Url(不带域名)',
            'content_group_ids' => '本节点使用的内容组 用英文逗号分割',
            'tpl_type' => '节点的类型',
            'tpl_url' => '节点使用的模版',
            'others' => 'JSSO数组设置',
            'status' => 'Status',
        ];
    }
	
	//得到部分数据的代号中文
	public static function getCh(){
		$retArr =   [
						'client' =>	[
										'1' => 'PC版',
										'2' => 'M版',
									],
									
						'type'	 => [
										'normal' => '单页面',
										'detail' => '多重页-详情页',
										'list'   => '多重页-列表页',
									],
					];
		return $retArr;
	}


    /**
     * 
     */
    public function search($params)
    {
		$site_id = CusSystem::getSiteId();
		
        $query = $this->find();
        $query->orderBy('filedir asc');
		$query->andWhere(['=', 'site_id', $site_id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>['pagesize'=>'30']
        ]);

        if (!($this->load($params))) {
            return $dataProvider;
        }
		//debug(get_defined_vars());die;
        if(!empty($this->client)){
            $query->andWhere(['=', 'client', $this->client]);
        }
		
		//debug($dataProvider);die;
        return $dataProvider;
    }	
	
	/*
		Added By ZhuCj 2015-07-16
		根据节点ID得到 该节点所实用的组数据
	*/
	public function getGroupsByNodeid($id){
		$retArr = [];
		$TempArr = $this->findOne($id);
		if(empty($TempArr['content_group_ids'])){
			return $retArr;
		}
		

		$retArr = explode(',',$TempArr['content_group_ids']);
		
		
		//echo $NodeArr->content_group_ids;		
		return $retArr;		
	}
	
	/*
		重要方法：
		得到这个节点所展现的页面需要用到的 
		暂时又弃用这部分了 取数据在页面也可取
	*/
	/*
	public function getDataByNodeid($id){
		$in_sql = '';
		$tempArr = $this->findOne($id);
		
		if(empty($tempArr->content_group_ids)){
			return 0;
		}

		$in_sql = '(' . $tempArr['content_group_ids'] . ')';
		$sql = 'select * from `sys_content_group` where id in ' . $in_sql;
		$groupArr = SysContentGroup::findBySql($sql)->all();
		$Codes2Id = [];
		foreach($groupArr as $val){
			$Codes2Id[$val->code] = $val->id;
		}

		$sql = 'select * from `sys_content_article` where `content_group_id` in ' . $in_sql;
		$articleRes = SysContentArticle::findBySql($sql)->all();		
		$Group2Article = [];
		foreach($articleRes as $val){
			$Group2Article[$val->content_group_id][] = $val;
		}
		
		$retArr = [];
		$retArr['tpl'] = $tempArr['tpl_url'];
		if(!empty($Codes2Id)){
			foreach($Codes2Id as $key => $val){
				$retArr['group'][$key] = $Group2Article[$val];
			}
		}
		return $retArr;
	}
	*/
	public function getList($site_id){
		
	}
	
	
	
	// 开发->节点展示 页面数据
 	public function devNodeIndex($param){
		$site_id = $param['site_id'];
		$limit = empty($param['limit']) ? 5 : $param['limit'];
		//echo $site_id;die;
		
		$query = $this->find();
		$query->andWhere(['=', 'site_id', $site_id]);		
		$pagination = new Pagination([
			'defaultPageSize' => $limit,
			'totalCount'      => $query->count(),
		]);
		$dataRes = $query->orderBy('filedir asc')->offset($pagination->offset)->limit($pagination->limit)->all();		
		
		$siteRes = SysSite::findOne($site_id);
		$dirArr  = CusSystem::getAllDir($siteRes->dir);
		
		$ch = $this->getCh();
		$retArr = [
					'data'       => $dataRes,
					'pagination' => $pagination,
					'dirArr'     => $dirArr,
					'ch'		 => $ch,
				  ];
		return $retArr;
	}
	
	
	
	
}
