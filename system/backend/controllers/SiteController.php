<?php
namespace backend\controllers;

use backend\models\Log;
use backend\models\SysUser;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use backend\models\SysSite;

/**
 * Site controller
 */
class SiteController extends Controller{
    /**
     * 访问权限设置
     */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index','create','update','member'],
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
     * 站点列表
     */
    public function actionIndex(){
        $model = new SysSite();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
        return $this->render('index',['dataProvider'=>$dataProvider,'model'=>$model]);
    }

    /**
     * @return string
     */
    public function actionCreate(){
        $model = new SysSite();

        $this->performAjaxValidation($model);

        if ($model->load(\Yii::$app->getRequest()->post())) {
            $model = $this->setPath($model);
            if($model->save()){
                Log::writeLog('创建新站点【'.$model->name.'】','site');
                $this->redirect(Url::to('/site'));
            }
        }

//        //设置添加目录值
//        $model->sitemap = 1;
//        $model->is_test = 0;
//        $model -> is_publish = 1;

        return $this->render('create',['model'=>$model]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionUpdate($id){
        $model = new SysSite();
        $model = $model->findOne($id);

        $this->performAjaxValidation($model);

        if ($model->load(Yii::$app->getRequest()->post())) {
            $model = $this->setPath($model);
            if($model->save()){
                Log::writeLog('更新站点【'.$model->name.'】','site');
                $this->redirect(Url::to('/site'));
            }
        }
        return $this->render('update',['model'=>$model]);
    }

    public function actionMember(){

        $model = new SysUser();
        $data = $model -> getUser(Yii::$app->request->queryParams);
        return $this ->render('member',['data' => $data,'model' => $model]);

    }

    /**
     * 保存数据之前设置发布、模板目录
     */
    protected function setPath($model){
        $temp = Yii::$app->params['tempRootPath'];
        if($model->is_test == 1){
            $pub = Yii::$app->params['testRootPath'];
        }else{
            $pub = Yii::$app->params['pubRootPath'];
        }
        $char = substr($temp,0,-1);
        if($char != DS){
            $temp .= DS;
        }

        $char = substr($pub,0,-1);
        if($char != DS){
            $pub .= DS;
        }

        $pcpath = str_replace('/',DS,$model->pc_domain);
        if(empty($model->pc_pub_path)){
            $model->pc_pub_path = $pub.$pcpath.DS;
        }
        if(empty($model->pc_temp_path)){
            $model->pc_temp_path = $temp.$pcpath.DS;
        }

        //未设置手机版域名
        if(empty($model->m_domain)){
            return $model;
        }

        if(empty($model->m_pub_path)){
            $arr1 = explode('/',$model->pc_domain);
            $arr2 = explode('/',$model->m_domain);
            $arr2[0] = $arr1[0].DS.'m';
            $model->m_pub_path = $pub.implode(DS,$arr2).DS;
        }
        if(empty($model->m_temp_path)){
            $arr1 = explode('/',$model->pc_domain);
            $arr2 = explode('/',$model->m_domain);
            $arr2[0] = $arr1[0].DS.'m';
            $model->m_temp_path = $temp.implode(DS,$arr2).DS;
        }

        return $model;
    }

    /**
     * @param Model $model
     * @throws \yii\base\ExitException
     */
    protected function performAjaxValidation(Model $model){
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            \Yii::$app->end();
        }
    }

}
