<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;

use backend\models\SysContent;
use backend\models\SysContentGather;
use backend\models\SysContentGlobal;


use backend\models\CusLoader;

/**
 * 例子测试控制器  
 */
class DemoController extends Controller
{
	/**
     * 访问权限设置
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                    //  'actions' => ['index','node','update','article'],		全部可以操作
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
	
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @param \yii\base\Action $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action){
        if($action->id == 'error'){
            $this->layout = '@backend/views/user/layouts/simple';
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
	
	public function actionZhutest(){
		$arr =  [
					[
						'type' => 'single',
						'code' => 'imga',
						'name' => '图标',
						'size' => '295x190',
						'img'  => 'http://jgstatic.snail.com/zcjgame/images/grid-img1.jpg',
					],
					
					/*
					[
						'type' => 'more',
						'code' => 'imgb',
						'name' => '游戏预览图',
						'size' => '72x72',
						'img'  => [
									'http://jgstatic.snail.com/m1/ginfo/1.jpg',
									'http://jgstatic.snail.com/m1/ginfo/2.jpg',
									'http://jgstatic.snail.com/m1/ginfo/3.jpg',
									'http://jgstatic.snail.com/m1/ginfo/4.jpg',
								  ],
					],
					*/
					
				];
		$json = json_encode($arr);	
		
		$model = new SysContent();
		$model->db->createCommand("update sys_content set j_imgs='$json'")->execute();  
				
		debug($json);		
	}
	
	public function actionZhutestb(){
		$arr = [
			'gather_id' => '3',
			'limit'     => '2',
		];
		$json = json_encode($arr);
		
		$sql = "update sys_node set `others`='$json' where id = 7";
		$model = new SysContent();
		$model->db->createCommand($sql)->execute();  
	}
	
	public function actionZhutestc(){
		$model = new SysContentGather();
		
		$gather_id = 5;
		$page  = 1;
		$limit = 2;
		
		$model->getContentByGatherAndPage($gather_id,$page,$limit);
		
		//getContentByGatherAndPage($gather_id,$page = 1,$limit = 20)
	}
	
	public function actionZhutestd(){
		echo 'sgaegaseg';
		$model = new SysContentGlobal();
		//$this->performAjaxValidation($model);
		$param = [  
					'site_id' => 4,
					'type' => 'text',
					'code' => '324234',
					'name' => 'gwagwaegawegwae',
					'other'=> 'fweaegweagaweg',
				];
				
		$model->site_id = 4;
		$model->type = 'text';
		$model->code = '34234324';
		$model->name = 'gwagwaegawegwae';
		$model->other = 'other';
		
		//$ss = $model->load($param);
		$ss = $model->save();
		debug($ss);
	}
	
	public function actionLoader(){
		$MCusLoader = new CusLoader();
		$id = 26;
		$res = $MCusLoader->getContent($id);
		debug($res);
	}
	
	
	//对象变成数组的Demo
	public function actionTa(){
		$res = SysContent::find()->all(); 
		foreach ($res as $val) {
			$result[] = $val->attributes;
		}
		debug($result);
	}
	
    protected function performAjaxValidation(Model $model){
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            \Yii::$app->end();
        }
    }	
}
