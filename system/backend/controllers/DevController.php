<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\widgets\ActiveForm;

use backend\models\CusSystem;
use backend\models\SysNode;
use backend\models\SysAlbum;
use backend\models\SysContentGlobal;
use backend\models\SysContentGather;


/**
 * Node controller
 * Added By ZhuCJ
 */
class DevController extends Controller{
	
	public $site_id;				//当前操作的站点ID
	
	/**
     * 访问权限设置
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        //'actions' => ['index','preview','create','update','output'],
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
	
	public function beforeAction($action){
		$this->site_id = CusSystem::getSiteId();
		return true;
	}

	public function actionIndex(){
		$this->actionNode();
	}
	
    /**
     * 结点页面展示
     */
    public function actionNode(){
        $model = new SysNode();
		if(empty($_GET['SysNode']['client'])){
			$_GET['SysNode']['client'] = 1;
		}
		$param = [
					'site_id' => $this->site_id,
					'limit'   => 20,
				 ];	
		$retArr = $model->devNodeIndex($param);
        return $this->render('node',$retArr);
    }	
	
	/*
     * 全局页面展示
	 */
	public function actionGlobal(){
		$model = new SysContentGlobal();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        return $this->render('global',['dataProvider'=>$dataProvider,'model'=>$model]);
	}
	

	//相册相关
	public function actionAlbum(){
		$model = new SysAlbum();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        return $this->render('album',['dataProvider'=>$dataProvider,'model'=>$model]);
        //return $this->render('album',$retArr);		
	}
	
	/*
		集合页面展示
		/content/gather
	*/
	public function actionGather(){
		$model = new SysContentGather();		//得到集合
        $dataProvider = $model->search(Yii::$app->request->queryParams);
		$retArr = ['dataProvider'=>$dataProvider,'model'=>$model];
        return $this->render('gather',$retArr);		
	}	
	
	public function actionDemo(){
		$retArr = [];
		return $this->render('demo',$retArr);	
	}
  
    protected function performAjaxValidation(Model $model){
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            \Yii::$app->end();
        }
    }
  
}
