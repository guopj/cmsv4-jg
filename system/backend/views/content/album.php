<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<section class="content-header">
    <h1>
        站点相册库<small></small>
    </h1>
	<ol class="breadcrumb">
		<li>
			<a href="#">
				<i class="fa fa-dashboard"></i>Home
			</a>
		</li>
		<li>
			<a href="#">UI</a>
		</li>
		<li class="active">Icons</li>
	</ol>
</section>

<section class="content">
    <div class="row">
        <?php
		foreach($res as $val){ 
		?>
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?= $val->name ?></h3>
					<p>相册数量:<?= $num[$val->id]['album_num'] ?></p>
					<p>照片数量:<?= $num[$val->id]['photo_num'] ?></p>
				</div>
				<!--
				<div class="icon">
					<i class="ion ion-bag"></i>
				</div>
				-->
				<a class="small-box-footer" href="/content/albumi?id=1">
				点击查看  <i class="fa fa-arrow-circle-right"></i>
				</a>
			</div>
		</div>
		<?php
		}
		?>
    </div>
</section>