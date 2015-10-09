<?php
namespace backend\models;
use Yii;
use yii\base\Model;

//use backend\models\CusLoader;
/**
 * 系统参数获取类 Added By ZhuCj 2015-07-23
 */
class CusSystem extends Model
{
	public static function getAllDir($site_domain){
		$sites_dir       = CMS_ROOT . '/sites/' . $site_domain;
		$sites_dir_pc    = $sites_dir . '/pc';
		$sites_dir_m     = $sites_dir . '/m';
		
		$templates_dir   = CMS_ROOT . '/../templates/' . $site_domain;
		$templates_dir_pc = $templates_dir  . '/pc';
		$templates_dir_m  = $templates_dir . '/m';
		//echo $templates_dir;die;
		
		//$templates_file = 'index.html';		
		$dirArr = [
					'site_pc' => realpath($sites_dir_pc),
					'site_m'  => realpath($sites_dir_m),
					'temp_pc' => realpath($templates_dir_pc),
					'temp_m'  => realpath($templates_dir_m),
				  ];		
		//debug($dirArr);die;
		
		return $dirArr;
	}
	
	public static function setSiteId($site_id){
		$session = Yii::$app->session;
		$res = SysSite::findOne($site_id);
		$site_name = $res['name'];
		
		$session->set('site_id'  , $site_id);
		$session->set('site_name', $site_name);
	}
	
	public static function getSiteId(){
		$session = Yii::$app->session;
		$return = $session->get('site_id');
		if(empty($return)){
			CusSystem::setSiteId(4);
			$return = $session->get('site_id');
		}
		return $return;
	}

	public static function getSiteName(){
		$session = Yii::$app->session;
		$return = $session->get('site_name');
		if(empty($return)){
			CusSystem::setSiteId(4);
			$return = $session->get('site_name');
		}	
		return $return;		
	}	
	
	/*
		Added By ZhuCj 
		2015-07-31
		自己写的弹窗样式，
		自带的用不来 :( 
	*/
	
	public static function getPopupStyle(){
		$retStr =  'border:2px solid #ccc;
					display:block;
					position:absolute;
					top:10%;
					left:30%;
					z-index:1050;
					width:400px;
					overflow:auto;
					border-top-color:#3c8dbc;
					border-top:3px solid #3c8dbc;';

		$retStr =  'display:none;
					border:2px solid #3c8dbc;
					position:absolute;
					top:10%;
					left:30%;
					z-index:1050;
					width:400px;
					overflow:auto;';
			
		return $retStr;
	}
	
	/*
		Added By ZhuCj 
		2015-08-04
		根据pagenation写的分页HTML
	*/
	public static function getPageHtml($pagination){
		$query_string = explode('&',$_SERVER['QUERY_STRING']);
		$no_page_query_string = '';
		if(!empty($query_string)){
			foreach($query_string as $val){
				if(strpos($val,  'page') !== false){
				}else{
					$no_page_query_string .= $val . '&';
				}
			}
		}
		//echo $no_page_query_string;die;
		
		$total = $pagination->totalCount;
		$limit = $pagination->defaultPageSize;
		$nowpage = empty($_GET['page']) ? 1 : $_GET['page'];
		$pageMax = intval($total / $limit);
		$lpage   = $nowpage > 1 ? $nowpage - 1 : 1;	
		$npage   = $nowpage < $pageMax  ?  $nowpage + 1 : $pageMax;
		$page_last_url = '?' . $no_page_query_string . 'page=' . $lpage;
		$page_next_url = '?' . $no_page_query_string . 'page=' . $npage;
		
		$disabled = ($nowpage == 1) ? 'disabled' : '';
		if($pageMax <= 1){
			return '';
		}
		
		$html = '<div class="row">' .
					'<div class="col-sm-5">' . 
						'<div class="dataTables_info">一共' . $total . '条数据</div>' .
					'</div>' .
				'<div class="col-sm-7">' .
					'<div class="dataTables_paginate paging_simple_numbers" style="float:right">' .
						'<ul class="pagination">' . 
						'<li class="paginate_button previous ' . $disabled . '">' . 
							'<a href="' . $page_last_url . '">上一页</a>' .
						'</li>';
		for($i=1; $i<=$pageMax; $i++){
			$page_url = $no_page_query_string . 'page=' . $i;
			$active =  ($nowpage == $i) ? 'active' : '';
			$html .= 	'<li class="paginate_button ' . $active . '">' .
							'<a href="?' . $page_url .  '" >'. $i .'</a>' . 
						'</li>' ;

		}
		
		$disabled = ($nowpage == $pageMax) ? 'disabled' : '';
		$html .= 		'<li class="paginate_button previous ' . $disabled . '">' . 
							'<a href="' . $page_next_url . '">下一页</a>' .
						'</li>' .
						'</ul>' .
					'</div>' .	
				'</div></div>';
		return $html;
	}



	
	//数据库中的JSON数组 MODEL示例
	public static function getSysContentOther(){
		//sys_node表中 type=detail时
		$res = [
			'gather_id' => '2',
		];
		
		//sys_node表中 type=list时
		$res = [
			'gather_id' => '3',
			'limit' => '2',
		];
	}
}
