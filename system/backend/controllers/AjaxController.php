<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;

use backend\models\CusAjaxSite;
use backend\models\CusAjaxContentGlobal;			//AJAX全局设置相关

/**
 * Ajax controller
 */
class AjaxController extends Controller{
    /**
     * Ajax控制器
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //'actions' => ['index','create','update'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action){
                            //编辑组无权限
                            return !Yii::$app->user->getIdentity()->getIsEditor();
                        }
                    ],
                ],
            ],
        ];
    }

	public function actionSite(){
		$retArr = ['status' => 0 ,'message' => 'not the right action'];
		$CusAjaxSite = new CusAjaxSite();
		$postData = Yii::$app->getRequest()->post();

		switch($postData['action']){
			case 'select':$retArr = $CusAjaxSite->select($postData['id']);
                break;
		}
		$json = json_encode($retArr);
		die($json);
	}

	//C 标识content缩写 随意定义 Added By ZhuCj 
	// 2015-07-31
	public function actionCglobal(){
		$retArr = ['status' => 0 ,'message' => 'not the right action'];	
		$model = new CusAjaxContentGlobal();
		
		$pData = Yii::$app->getRequest()->post();
		
		//	$pData = Yii::$app->getRequest()->get();
		
		$retArr = $model->$pData['action']($pData);
		if(is_array($retArr)){
			$return = json_encode($retArr);				
		}else{
			$return = $retArr;
		}
		die($return);		
	}
	
}
