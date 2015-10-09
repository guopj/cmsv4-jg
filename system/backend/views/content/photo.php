<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<section class="content-header">
    <h1>
        相册照片<small>相册:</small>
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
			<button class="btn btn-primary btn-lg">返回</button>
			<button class="btn btn-primary btn-lg">上传照片</button>
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="col-md-10">
			<div class="box box-info">

				<div class="box-header with-border"> 
					<h3 class="box-title"></h3>
					<div class="box-tools pull-right"></div>
					<div class="box-body no-padding">
						<?php
						foreach($data as $val){
						?>
							<div class="col-sm-3">
								<a href="#"><img class="margin" width="120px" height="100px" lt="..." src="<?= $val->img ?>" /></a>
								<br/>	
								<div class="col-md-6">
								<a href="#"><i class="fa fa-fw fa-pencil"></i></a>
								<a href="#"><i class="fa fa-fw fa-eraser"></i></a>
								</div>
							</div>
						<?php
						}
						?>
					</div>
					<div class="box-footer text-center">
						<!--<a class="uppercase" href="javascript::">View All Users</a>-->
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-2">
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">相册信息</h3>
					<div class="box-tools pull-right"></div>
					<div class="box-body no-padding">

								
								<img alt="User Image" width="200px" height="200px" src="http://placehold.it/150x100">
								
								<a class="users-list-name" href="javascript:;">AAAAAAA</a>
								<span class="users-list-date">
									BBBBBBBBBBBBB
								</span>
								<a href="#"><i class="fa fa-fw fa-pencil"></i></a>
								<a href="#"><i class="fa fa-fw fa-eraser"></i></a>
					</div>
					<div class="box-footer text-center">
						<!--<a class="uppercase" href="javascript::">View All Users</a>-->
					</div>
				</div>			
			</div>
		</div>
	</div>
</section>