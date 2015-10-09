<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<section class="content-header">
    <h1>
        站点相册<small></small>
    </h1>
	<ol class="breadcrumb">
		<li>
			<a href="#">
				<i class="fa fa-dashboard"></i>首页
			</a>
		</li>
		<li>
			<a href="#">相册</a>
		</li>
		<li class="active">站点相册</li>
	</ol>	
</section>

<section class="content">
	
		<div class="row">
			<div class="col-md-12">
				
				<button class="btn btn-primary btn-lg">新建相册</button>
				
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title"></h3>
						<div class="box-tools pull-right"></div>
						<div class="box-body no-padding">
							<ul class="users-list clearfix">
								<?php
								foreach ($data as $val){
								?>
								
								<li>
									<a class="users-list-name" href="/content/albump?id=<?= $val->id ?>">
										<img alt="User Image" width="128px" height="128px" src="<?= $val->cover ?>">
									</a>
									<a class="users-list-name" href="/content/albump?id=<?= $val->id ?>"><?= $val->title ?></a>
									<span class="users-list-date">
										<?= $val->subtitle ?>
									</span>
									<a href="#"><i class="fa fa-fw fa-pencil"></i></a>
									<a href="#"><i class="fa fa-fw fa-eraser"></i></a>
								</li>
								<?php
								}
								?>
						
							</ul>
						</div>
						<div class="box-footer text-center">
							<!--<a class="uppercase" href="javascript::">View All Users</a>-->
						</div>
					</div>
				</div>
			</div>
		</div>
	
</section>