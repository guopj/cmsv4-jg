<?php
namespace backend\models;
use Yii;

use backend\models\CusLoader;

use backend\models\SysNode;
use backend\models\SysContentGather;

/**
3 * 生成页面类 Added By ZhuCj 2015-07-17
 */
class CusBuild extends \yii\db\ActiveRecord
{
	//核心功能函数 读取节点 生成到文件
	public function saveAllNode()
	{
		$site_id = 3;
		
		// ****************************** //
		// ****************************** //
		// ****************************** //
		
		$GroupsArr = SysContentGroup::find()->andWhere(['site_id' => 3])->all(); 
		debug($GroupsArr);die;
		
		foreach($GroupsArr as $val){
			$Codes2Id[$val->code] = [
									'id' => $val->id,
									//'' ,
									];
		}
		debug($Codes2Id);
	}
	
	
	//读取一个节点的信息
	public function readOneNode($site_id,$node_id)
	{
		$siteRes = SysSite::findOne($site_id);
		$siteDir = $siteRes->dir;
		
		$nodeRes = SysNode::findOne($node_id); 
		if(!empty($nodeRes->others)){
			$nodeOthers = json_decode($nodeRes->others);
		}		

		//计算模版路径相关
		$dirArr = CusSystem::getAllDir($siteDir);
		if($nodeRes->client == 1){
			//此为PC节点
			$siteDir = $dirArr['site_pc'] . $nodeRes->filedir;
			$templates_dir = $dirArr['temp_pc'];
			$staticDomain = $siteRes->pc_static;
										
		}else{
			//M节点路径计算
			$siteDir = $dirArr['site_m'] . $nodeRes->filedir;
			$templates_dir = $dirArr['temp_m'];
			$staticDomain = $siteRes->m_static;
			
		}
		
		create_dir($siteDir);
		$template = $templates_dir . '/' . $nodeRes->tpl_url;
		$siteSrc = $siteDir . $nodeRes->filename;
		
		$MCusLoader = new CusLoader();
		$retArr = [
			'type'         => $nodeRes->type,
			'staticDomain' => $staticDomain ,
		  //'siteDir'      => $siteDir,
			'siteSrc'      => $siteSrc,
			'templates_dir'=> $templates_dir,
			'template'	   => $template,
			'loader'       => $MCusLoader,
		];
			
		if($nodeRes->type == 'normal'){
			return $retArr;
		}
		
		
		if($nodeRes->type == 'detail'){
			
			$res = SysContent::find()->where(['site_id' => $site_id])->all(); 	//得到当前站点的所有文章
			$retArr['res'] = $res;
			return $retArr;			
		}
		
		//包含分页列表页
		if($nodeRes->type == 'list'){
			$MSysContentGather = new SysContentGather();
			//这个组数据 $nodeRes->content_gather_id
			//$gather_id = $nodeRes->content_gather_id;
			//debug($nodeOthers);die;
			
			
			$gather_id = $nodeOthers->gather_id;
			$res = $MSysContentGather->getMaxpageByGatherAndPage($gather_id,$limit = 2);		//得到分页最大值
			
			$content_ids = $res['content_ids'];
			$pageMax = $res['pageMax'];
			
			$retArr['content_ids'] = $content_ids;
			$retArr['limit'] = $limit;
			$retArr['pageMax'] = $pageMax;
			return $retArr;
		}		
	}
}
