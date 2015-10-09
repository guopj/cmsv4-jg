<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use backend\models\SysContent;
use backend\models\SysContentGroup;
//use backend\models\SysContentGlobal;
//use backend\models\SysContentArticle;
use backend\models\SysContentGather;

/*
	本类组织传递给HTML的数据组 方法组合集
	Added By ZhuCj 
	2015-07-20
*/
 
 
class CusLoader extends \yii\db\ActiveRecord
{
	/*
	得到一个模型的数据组合
	$model
	*/
	public function getAll($model = 'group' ,$code = ''){
		$site_id = 3;
		switch($model){
			case 'group' :return $this->getGroupByCode($site_id , $code);break;
			case 'gather':return $this->getByContentGatherCode($site_id , $code);break;
		}
		
	}
	
	/*
	得到一个模型的单条数据
	*/
	public function getOne($model = 'global' ,$code = ''){
		$site_id = 3;
		switch($model){
			//case 'content':return $this->getContentById($id);
			case 'global':return $this->getGlobalByCode($site_id , $code);
		}
	}
	
	public function getContent($id){
		return $this->getContentById($id);
	}
	
	//页码 1 文件名 game#.html
	public function getPageLink($p,$filename){
		//$filename
		$ret = str_replace("#", '-p' . $p, $filename);		
		return $ret;
	}
   
   /*
	public function getList($page = 1 , $pageSize = 5){
	}
   */
   
    /*
	public function getAllbyId(){
	}
	*/

	
	//根据组代码取数据
	private function getGroupByCode($site_id, $code){
		$groupRes = SysContentGroup::find()->where(['site_id' => $site_id, 'code' => $code])->one();
		//debug($groupRes);die;
		if(empty($groupRes['id'])){
			//该组这个code不存在
		
		}
		
		//如果该分组是文章的话 
		if($groupRes['type'] == 'article'){
			$artRes = SysContent::find()->where(['site_id' => $site_id, 'content_group_id' =>$groupRes['id'] ])->all();
			//debug($artRes);die;
			
			//$artRes = ArrayHelper::map($artRes, 'id',');
			//debug($artRes);die;
			return $artRes;
		}
	}
	
	//根据站点ID, 代号查询一个内容集合
	private function getByContentGatherCode($site_id , $code){
		$gatherRes = SysContentGather::find()->where(['site_id' => $site_id, 'code' => $code])->one();
		//echo $gatherRes->content_ids;
		$contentRes = [];
		if(!empty($gatherRes->content_ids)){
			//$content_ids = explode(',' , $gatherRes->content_ids);
			$sql_in = '(' . $gatherRes->content_ids . ')'; 
			$sql_db = SysContent::tableName();
			$sql = 'select * from ' . $sql_db . ' where id in ' . $sql_in ;
			$contentRes = SysContent::findBySql($sql)->all();
			//debug($contentRes);die;
		}
		return $contentRes;
	}
	
	
	private function getGlobalByCode($site_id,  $code){
		$res = SysContentGlobal::find()->where(['site_id' => $site_id, 'code' =>$code ])->all();
		//debug($res);die;
		return $res[0]->val;
	}
	
	//根据Content表 ID取Content数据
	private function getContentById($id){
		$contentRes = SysContent::findOne($id);
		$contentRes = SysContent::processData($contentRes);	//加工数据
		return $contentRes;
		//debug($contentRes);
	}
	


	
}
