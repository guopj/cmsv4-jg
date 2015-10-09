<?php
namespace backend\models;
use Yii;

use backend\models\CusSystem;

use backend\models\SysContentGlobal;

class CusAjaxContentGlobal extends \yii\db\ActiveRecord
{
	/*
    [action] => add
    [_csrf] => WG8zZkFXS2FoKFkiKzAPBBYFBgcbZSktCA5pAHkHfhlpPHYlFCU8Vg==
    [type] => text
    [code] => 324234
    [name] => gwagwaegawegwae
    [other] => Array
        (
            [0] => 11111
            [1] => 22222
            [2] => 33333
        )
	*/
	public function add($param){
		//debug($param);
		$site_id = CusSystem::getSiteId();
		$retArr = ['status'=>0,'message'=>'error','data'=>[]];		
		$model = new SysContentGlobal();
		
		//检查代号不允许重复
		$where = [
					'site_id' => $site_id,
					'code'    => $param['code'],
				 ];
		$res = SysContentGlobal::find()->where($where)->one();
		if(!empty($res)){
			return ['status'=>0,'message'=>'代号不允许重复'];	
		}
		
		$model->site_id = $site_id;
		$model->type = $param['type'];
		$model->code = $param['code'];
		$model->name = $param['name']; 
		
		if(is_array($param['other'])){
			$model->other = json_encode($param['other']);
		}else{
			$model->other = '';
		}
		if($model->save()){
			$retArr = ['status'=>1,'message'=>'OK'];		
		}
			
		return $retArr;
		//SysContentGlobal::
	}
	
	public function get($param){
		$site_id = CusSystem::getSiteId();
		$retArr = ['status'=>0,'message'=>'error','data'=>[]];		
		//debug($param);
		$id = $param['id'];
		$html = '<div>sb</div>';
		$retArr = $html;
		return $retArr;
		
		echo $id;
		
		
		
		
		
		
		
		
		
		
		
		
	}
	
}
