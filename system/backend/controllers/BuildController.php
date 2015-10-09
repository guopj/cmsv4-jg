<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\base\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;

use backend\models\CusSystem;
use backend\models\CusBuild;
use backend\models\CusMenu;

use backend\models\SysContentGather;

/**
 * Build controller
 * Added By ZhuCJ
 */
class BuildController extends Controller{
	
	public $site_id;
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

	//开始方法前
	public function beforeAction($action){
		$this->site_id = CusSystem::getSiteId();
		return true;
	}	
	
    /**
     * 结点页面展示
     */
    public function actionIndex(){
        //$model = new SysContentGroup();		//得到分组数据
		//echo 111;die;
		$retArr = [];
        return $this->render('index',$retArr);
    }

	/*
	public function actionNode(){
		$MBuild = new CusBuild();
		$MBuild->saveAllNode();
		die;
		
		
		$siteDomain   = 'jdzcj.snail.com';
		$staticDomain = 'http://jgstatic.snail.com/test1';		//临时测试 临时测试

		$MSysNode = new SysNode();
		$nodeData = $MSysNode->getDataByNodeid($id);

		
		//计算模版路径相关
		$templates_dir  = __DIR__ . '/../../../cmsroot/' . $siteDomain . '/templates/';
		$templates_file = $nodeData['tpl'];
		$template = $templates_dir . $templates_file;
		
		$retArr =   [
						'data'         => $nodeData,
						'staticDomain' => $staticDomain,
					];
		
		$realdir = 1;
		
		//$html = $this->renderPartial($template,$retArr,$realdir = 1);	//realdir为新增属性 读取指定死路径
		$html = $this->renderFile($template,$retArr);
		return $html;
		
		file_put_contents('test.html',$html);
		return; 		
		
		
		
		$retArr['res'] = [
							'status'  => 1,
							'message' => '成功生成 4 个单页节点',
					     ];
		$retArr['res'] = json_encode($retArr['res']); 			
		die($retArr['res']);
		//$this->renderAjax('ajax',$retArr);
	}
	*/

    /**
     *
     */
    public function actionArticle(){
		$retArr['res'] = [
							'status'  => 1,
							'message' => '成功生成 12 篇文章',
					     ];
		$retArr['res'] = json_encode($retArr['res']); 			
		die($retArr['res']);
		//$this->renderAjax('ajax',$retArr);
	}	

    /**
     * 预览一个页面结点
     * @param $id
     * @return string
     */
    public function actionPreview($id){
		$site_id = $this->site_id;
		//echo $site_id;
		//die;
		
		//写死写死写死写死写死
		
		$MCusBuild = new CusBuild();		
		$saveOneRes = $MCusBuild->readOneNode($site_id,$id);
		$retArr =   [
						'LOADER'     => $saveOneRes['loader'],
						'TEMPLATE'	 => $saveOneRes['templates_dir'],
						'STATIC'     => $saveOneRes['staticDomain'],
					];

		//echo $saveOneRes['template'];die;
		
		//普通页面 单张页面
		if($saveOneRes['type'] == 'normal'){		
			$html = $this->renderFile($saveOneRes['template'],$retArr);	
		}
		
		//详情页面 多张页面
		if($saveOneRes['type'] == 'detail'){
			if(empty($saveOneRes['res'][0]->id)){
				die('结点无内容');
			}
			$ID = $saveOneRes['res'][0]->id;
			$retArr['ID'] = $ID;
			$html = $this->renderFile($saveOneRes['template'],$retArr);	
		}
		return $html;		
	}


    /**
     * 生成一个节点的入口
     * @param $id
     */
    public function actionOnenode($id){
		$site_id = $this->site_id;			//取得当前正在操作的站点ID
		
		$MCusBuild = new CusBuild();
		$MSysContentGather = new SysContentGather();
		
		$saveOneRes = $MCusBuild->readOneNode($site_id,$id);
		//debug($saveOneRes);die;
		
		if(!in_array($saveOneRes['type'] , ['normal','detail','list'])){
			die('Not the right type!');
		}
	
		$retArr =   [

                        'LOADER'       => $saveOneRes['loader'],
						'TEMPLATE'	   => $saveOneRes['templates_dir'],
						'STATIC'       => $saveOneRes['staticDomain'],
					];
	
		//普通页面 生成单张页面
		if($saveOneRes['type'] == 'normal'){
			$siteSrc = $saveOneRes['siteSrc'];
			$html = $this->renderFile($saveOneRes['template'],$retArr);	
			$zijie = file_put_contents($siteSrc,$html);
			echo $siteSrc . ' Updated ' . "<br/>";
		}

		
		//详情页面 生成多张详情页
		if($saveOneRes['type'] == 'detail'){
			if(!empty($saveOneRes['res'])){
				foreach($saveOneRes['res'] as $val){
					$ID = $val->id;
					$siteSrc = str_replace("#",$ID,$saveOneRes['siteSrc']);
					$retArr['ID'] = $ID; 
					
					$html = $this->renderFile($saveOneRes['template'],$retArr);	
					file_put_contents($siteSrc,$html);					
					echo $siteSrc . ' Updated ' . "<br/>";
				}
			}
		}
		
		//列表页面 分页多张页 不再依靠传递的LOADER了 直接读取相关值
		if($saveOneRes['type'] == 'list'){
			$pageMax = $saveOneRes['pageMax'];
			$limit   = $saveOneRes['limit'];
			$content_ids = $saveOneRes['content_ids'];
			for($page = 1;$page <= $pageMax;$page ++){
				$siteSrc = str_replace("#",'-p' . $page,$saveOneRes['siteSrc']);
				//$pageurl = str_replace("#",'-p' . $page,$saveOneRes['siteSrc']);				
				
				$pageurl = basename($saveOneRes['siteSrc']);
				//$pageurl = str_replace("#",'-p',$pageurl);
				//echo $pageurl;die;
				
				$res = $MSysContentGather->getContentByGatherAndPage($content_ids,$page,$limit);

				
				$retArr['CONTENT'] = $res;
				$PAGE = [
							'page'    => $page,
							'pagemax' => $pageMax,
							'pageurl' => $pageurl,
						];
				$retArr['PAGE'] = $PAGE;
				//debug($PAGE);
				$html = $this->renderFile($saveOneRes['template'],$retArr);	
				file_put_contents($siteSrc,$html);					
				echo $siteSrc . ' Updated ' . "<br/>";		
			}
		}		
		//return $html;
	}

    protected function performAjaxValidation(Model $model){
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            echo json_encode(ActiveForm::validate($model));
            \Yii::$app->end();
        }
    }

}
