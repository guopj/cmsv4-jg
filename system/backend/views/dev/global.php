<?php
use backend\models\CusSystem;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>
<section class="content-header">
    <h1>
        全局设置<small></small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
					<p>
						<a class="btn btn-success" href="javascript:;" id="btn-add">添加</a>
					</p>
                </div>
                <div class="box-body">
					<div class="row">
						<div class="col-sm-12">
						<?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            //'filterModel'  => $model,
                            'columns' => [
                              //['class' => 'yii\grid\SerialColumn'],
                                [
									'attribute' => 'type',
								],
								[
                                    'attribute'=>'name',
                                    //'options'=>['width'=>'10%']
                                ],
                                [
                                    'attribute'=>'code',
                                    //'options'=>['width'=>'10%']
                                ],		
                                [
                                    'attribute'=>'val',
                                    //'options'=>['width'=>'10%']
                                ],	
                                [
                                    'header' => "操作",
                                    'value' => function ($model, $index, $widget) {
										return 
										'<a fun="btn-edit" gid="' . $model->id . '" class="btn btn-xs btn-success" href="javascript:;">编辑</a> '.
										'<a class="btn btn-xs btn-danger" target="_blank" href="/build/onenode?id=' . $model->id . '">删除</a> ';
									},
                                    'format' => 'raw',
                                ],
                            ],

                        ]); 
						?>
						</div>
					</div>
					
				</div>
			</div>
		</div>
    </div>
</section>

<div id="html-add" class="box box-primary" style="<?= CusSystem::getPopupStyle();?>">
	<div class="box-header" style="background-color:#3c8dbc">
		<h3 class="box-title"><font color="#FFFFFF" id="html-add-title">添加全局数据</font></h3>
		<div class="box-tools pull-right">
		<button class="btn btn-box-tool" data-widget="collapse">
			<i class="fa fa-minus"></i>
		</button>
		<button class="btn btn-box-tool" data-widget="remove">
			<i class="fa fa-times"></i>
		</button>
		</div>
	</div>
	<?php $form = ActiveForm::begin(['id'=>'form','action' => ['#'],'options'=>['enctype'=>'multipart/form-data']]); ?>
	<div class="box-body" id="html-add-box">
		<div class="form-group">
			<label>类型</label>
			<select id="select-type" name="type" class="form-control ">
				<option value="text">文本</option>
				<option value="select">选择项</option>
			<!--<option >图片</option>-->
			</select>
		</div>
		<div class="form-group">
			<label>代号</label>
			<input name="code" class="form-control" placeholder="请输入代号">
		</div>
		<div class="form-group">
			<label>名称</label>
			<input name="name" class="form-control" placeholder="请输入名称">
		</div>	
		
		<div id="div-isshow" class="form-group">
			<label>选择项 <a id="btn-add-other" href="javascript:;" class="btn btn-block btn-success btn-sm">增加选项</a></label>
			<div id="div-other" class="form-group">
				<div style="float:right">
					<a fun="btn-del-other" href="javascript:;" class="btn btn-block btn-danger btn-sm">删除</a>
				</div>
 				<div style="float:right">
					<a fun="btn-del-other" href="javascript:;" class="btn btn-block btn-danger btn-sm">删除</a>
				</div>
				<input name="other[]" class="form-control input-sm" style="width:80%"  placeholder="请输入选项名称">

				<div style="float:right">
					<a fun="btn-del-other" href="javascript:;" class="btn btn-block btn-danger btn-sm">删除</a>
				</div>
				<input name="other[]" class="form-control input-sm" style="width:80%"  placeholder="请输入选项名称">
				
			</div>	
		</div>				
	</div>
	</form>
	<div class="box-footer">
		<button class="btn btn-primary" idz="btn-save">保存</button>
	</div>
</div>

<?php
    $this->registerJsFile("/static/backend/js/dev/global.js");
?>
<!--<script src="/static/backend/js/dev/global.js"></script>-->
