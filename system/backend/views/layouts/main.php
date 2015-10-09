<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\CusMenu;
use backend\models\CusSystem;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title>极光平台-CMSV4</title>
    <?php $this->head() ?>
</head>
<body class="skin-blue">
    <?php $this->beginBody() ?>

    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            
			<a href="index2.html" class="logo">
                <span class="logo-lg">极光平台CMSV4</span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="/static/dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />
                                <span class="hidden-xs"><?= Yii::$app->user->getIdentity()->realname ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="/static/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                    <p>
                                        <?= Yii::$app->user->getIdentity()->realname ?> - <?= Yii::$app->user->getIdentity()->getRoleName() ?>
                                        <small>创建日期 <?= date('Y-m-d',Yii::$app->user->getIdentity()->created_at) ?></small>
                                    </p>
                                </li>
                                <?php if(Yii::$app->user->getIdentity()->getIsAdmin()){ ?>
                                <li class="user-body">
                                    <div class="col-xs-12 text-center">
                                        <a href="<?= Url::to('/user/admin/index') ?>" target="_blank">用户管理</a>
                                    </div>
                                </li>
                                <?php } ?>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?= Url::to(['/user/profile/show','id'=>Yii::$app->user->getIdentity()->id]) ?>" class="btn btn-default btn-flat">个人信息</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?= Url::to('/user/security/logout') ?>" class="btn btn-default btn-flat">注销</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

		<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- Sidebar user panel -->
				<div class="user-panel">
					
					<div class="pull-left image">
						<img src="/static/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
					</div>
					<div class="pull-left info">
						<p><?=CusSystem::getSiteName()?></p>
						<a href="#"><i class="fa fa-circle text-success"></i>SiteId <?=CusSystem::getSiteId()?></a>
					</div>
				</div>

				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li>
						<a href="<?= Url::to('/') ?>">
							<i class="fa fa-folder"></i> <span>首页</span>
						</a>
					</li>				
					<?php
					$menu = CusMenu::getMenu();
					foreach($menu as $key=>$val){
					?>	
					<li class="treeview<?php if($val['set'] == 1) echo ' active'?>">
						<a href="#">
							<i class="fa fa-folder"></i> <span><?= $val['label'] ?></span> <i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<?php
							if(!empty($val['child'])){
							foreach($val['child'] as $keyb=>$valb){
							?>
							<?php 
							if($valb['set'] == 1){ 
							?>
							<li class="active" >
							<?php	
							}else{
							?>
							<li>
							<?php
							}
							?>
							<a href="<?= Url::to($valb['url']) ?>"><i class="fa fa-circle-o"></i><?= $valb['label'] ?></a>
							</li>
							<?php
							}}
							?>
						</ul>
					</li>						
						
						
					<?php	
					}
					?>
				</ul>
			</section>
		</aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $content ?>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>CMS</b> V4
            </div>
            <strong>Copyright &copy; <?= date('Y') ?> <b>SnailGame</b>.</strong> All rights reserved.
        </footer>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
