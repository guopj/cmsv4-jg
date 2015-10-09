<?php
use backend\models\CusSystem;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
?>
<section class="content-header">
    <h1>
        全站通用<small></small>
    </h1>
</section>
<section class="content">
    <div class="row">
		<div class="col-md-4">
			<div class="box box-primary">
				<?php
				//debug($data);
				?>
				
				<!--
				<div class="box-header">
					<h3 class="box-title">全站通用</h3>
				</div>
				-->
				<div class="box-body">
					<?php
					foreach($data as $val){
					?>
					<div class="form-group">
						<label><?=$val->name?></label>
						<?php
						if($val->type == 'text'){
						?>					
						<input class="form-control" type="text" value="<?=$val->val?>" placeholder="请输入 ...">

						<?php
						}elseif($val->type == 'select'){
						?>
						<select class="form-control">
							<?php
							foreach($val->other as $valb){
							?>
							<option value="<?=$valb?>" ><?=$valb?></option>
							<?php
							}
							?>
						</select>
						<?php
						}
						?>
					</div>
					<?php
					}
					?>
					
				</div>
			</div>
		</div>
		
		<!--
		<div class="col-md-4">
			<div class="box box-primary">
				<div class="box-body">
					<div class="form-group">
						<label>Text</label>
						<input class="form-control" type="text" placeholder="Enter ...">
					</div>
					
					<div class="form-group">
						<label>Select</label>
						<select class="form-control">
							<option>option 1</option>
							<option>option 2</option>
							<option>option 3</option>
							<option>option 4</option>
							<option>option 5</option>
						</select>
					</div>
				</div>
			</div>
		</div>	
		-->

		
    </div>
	
	<button class="btn btn-primary" type="submit">全部保存</button>
	
</section>

<div class="bootstrap-wysihtml5-insert-link-modal modal fade" style="display:none;" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
		<a class="close" data-dismiss="modal">×</a>
		<h3>Insert link</h3>
		</div>
		<div class="modal-body">
		<input class="bootstrap-wysihtml5-insert-link-url form-control" value="http://">
		<div class="checkbox">
		<label>
		<input class="bootstrap-wysihtml5-insert-link-target" type="checkbox" checked="">
		Open link in new window
		</label>
		</div>
		</div>
		<div class="modal-footer">
		<a class="btn btn-default" data-dismiss="modal">Cancel</a>
		<a class="btn btn-primary" data-dismiss="modal" href="#">Insert link</a>
		</div>
		</div>
	</div>
</div>


