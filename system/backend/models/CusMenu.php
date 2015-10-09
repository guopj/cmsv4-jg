<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/*
	本类组织传递给HTML的数据组 方法组合集
	Added By ZhuCj 
	2015-07-20
*/
 
 
class CusMenu extends \yii\db\ActiveRecord
{
	public static function getMenu(){
		$retArr = [
			'site'  =>  [
							'label' => '站点',
							'url'	=> '#',
							'child' =>  [
											['label' => '站点列表' , 'url' => '/site'],
											['label' => '创建站点' , 'url' => '/site/create'],
											['label' => '用户列表' , 'url' => '/site/member'],
											['label' => '角色列表' , 'url' => '/site/create'],
											['label' => '操作日志' , 'url' => '/site/create'],
										],
						],
						
			'dev'   =>  [
							'label' => '开发',
							'url'	=> '#',
							'child' =>  [
											['label' => '节点' , 'url' => '/dev/node'],
										    ['label' => '集合' , 'url' => '/dev/gather'],
											['label' => '全站通用' , 'url' => '/dev/global'],
											['label' => '相册'     , 'url' => '/dev/album'],
										],
						],
			
			'content' =>[
							'label' => '内容',
							'url'	=> '#',
							'child' =>  [
											['label' => '内容集合' , 'url' => '/content/gather'],
											['label' => '内容查看' , 'url' => '/content/list'],
											['label' => '全站通用' , 'url' => '/content/global'],
											['label' => '相册'     , 'url' => '/content/album'],
										],
						],		
			
			'seo'	  =>[
							'label' => 'SEO',
							'url'	=> '#',
							'child' =>  [
											['label' => '页面' , 'url' => '/seo/index'],
										],
						],
						
			'build'   =>[
							'label' => '上线',
							'url'	=> '#',
							'child' =>  [
											['label' => '批量生成' , 'url' => '/build'],
										],				
						],
		];
		
		//得到菜单是否选中的事情
		$now_url = $_SERVER['REQUEST_URI'];		//   "/build/test"
		foreach($retArr as $key=>$val){
			$retArr[$key]['set'] = 0;
			if(!empty($val['child'])){
				foreach($val['child'] as $keyb=>$valb){
					if(is_int(strpos($now_url,$valb['url']))){
						$retArr[$key]['child'][$keyb]['set'] = 1;
						$retArr[$key]['set'] = 1;
					}else{
						$retArr[$key]['child'][$keyb]['set'] = 0;
					}
				}
			}
		}
		
		//debug($retArr);die;
		return $retArr;
	}
}
