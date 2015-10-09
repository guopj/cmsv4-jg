<?php
namespace backend\models;
use Yii;

use backend\models\CusSystem;

class CusAjaxSite extends \yii\db\ActiveRecord
{
	public function select($site_id){
		CusSystem::setSiteId($site_id);
		$retArr = [
						'status'=>1,
						'message'=>'Ok',
						'data'=>[],
				  ];
		return $retArr;
	}
}
