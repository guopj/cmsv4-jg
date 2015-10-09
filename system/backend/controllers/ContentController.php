<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
//use yii\helpers\ArrayHelper;

use yii\data\Pagination;
use yii\web\Controller;
//use yii\web\Response;

use yii\filters\AccessControl;
//use yii\widgets\ActiveForm;

use yii\base\Model;
					
use backend\models\SysContent;
use backend\models\SysContentGather;
use backend\models\SysContentGlobal;

//use backend\models\SysContentGroup;
//use backend\models\SysContentArticle;

use backend\models\SysAlbum;
use backend\models\SysAlbumDir;
use backend\models\SysAlbumPhoto;


/**
 * Node controller
 * Added By ZhuCJ
 */
class ContentController extends Controller{
	/**
     * 访问权限设置
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

    /**
     * 结点页面展示
	 * /content/index
     */
    public function actionIndex(){
        $model = new SysContentGroup();		//得到分组数据
        $dataProvider = $model->search(Yii::$app->request->queryParams);
		$retArr = ['dataProvider'=>$dataProvider,'model'=>$model];
        return $this->render('index',$retArr);
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

    /**
     * @return string
     */
    public function actionGlobal(){
		$model = new SysContentGlobal();
		$res = $model->getContentGlobal();
		//debug($res);die;
		$retArr['data'] = $res;
		return $this->render('global',$retArr);	
	}


    /**
     * @return string
     * Url:/content/article
     */
    public function actionList(){
        $model = new SysContent();
        $dataProvider = $model->search(Yii::$app->request->queryParams);
		$retArr = [
					'dataProvider' => $dataProvider,
					'model'        => $model,
				  ];
        return $this->render('list',$retArr);
    }

    /**
     * @return string
     */
    public function actionAlbum(){
		$site_id = 3;
		$retArr = [];
		$MSysAlbum  = new SysAlbum();
		$retArr = $MSysAlbum->getAlbumNum($site_id);
		return $this->render('album',$retArr);
	}

    /**
     * @param $id
     * @return string
     */
    public function actionAlbumi($id){
		$retArr = [];
		$model = new SysAlbumDir();
		$res = $model->find()->where(['album_id' => $id])->all();
		$retArr['data'] = $res;
		return $this->render('albuminfo',$retArr);		
	}

    /**
     * @param $id
     * @return string
     */
    public function actionAlbump($id){
		$retArr = [];
		$MSysAlbumPhoto = new SysAlbumPhoto();
		$res = $MSysAlbumPhoto::find()->where(['album_dir_id'=>$id])->all();
		$retArr['data'] = $res;
		return $this->render('photo',$retArr);
	}
}
