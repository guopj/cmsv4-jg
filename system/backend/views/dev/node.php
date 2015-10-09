<?php
use backend\models\CusSystem;
?>
<section class="content-header">
    <h1>
        结点设置<small>生成按结点进行</small>
    </h1>
</section>
<!--
<div class="pad margin no-print">
	<div class="callout callout-info" style="margin-bottom: 0!important;">
		<h4></h4>
		PC站点：<?= $dirArr['site_pc']?>   <br/>
		PC模版：<?= $dirArr['temp_pc']?>  <br/>
		M站点: <?= $dirArr['site_m']?>	<br/>
		M模版: <?= $dirArr['temp_m']?>	<br/>
	</div>
</div>
-->
<section class="content">
	<div class="row">
	</div>

    <div class="row">
		<div class="col-xs-12">
			<div class="box">
                <div class="box-header">
					<!--
					<ul class="nav nav-tabs pull-left">
						<li class="<?php if($_GET['SysNode']['client'] == 1) echo 'active';?>"><a href="?SysNode[client]=1" >PC版</a></li>
						<li class="<?php if($_GET['SysNode']['client'] == 2) echo 'active';?>"><a href="?SysNode[client]=2" >M版</a></li>
					</ul>	
					-->
					
					<p>
						<a class="btn btn-primary" href="javascript:;" id="btn-add">添加节点</a>
						<a class="btn btn-primary" href="javascript:;" id="btn-add">导入节点</a>
					</p>					
					<hr/> 
					<!-- filler 搜索选择部分 搜索框子-->
					<div>
						<label>
							客户端:
							<select name="f_" aria-controls="example1">
								<option value="a">全部</option>
								<option value="1">PC版</option>
								<option value="2">M版</option>
							</select>
						</label>
						<label>
							节点名:
							<input aria-controls="example1" />
						</label>	
						<label>
							<button class="btn btn-primary btn-sm" aria-controls="example1">搜索</button>
						</label>								
					</div>

				</div>
				
				
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12">
							<table class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
							<thead>
								<tr role="row">
									<th>行号</th>
									<th>目录</th>
									<th>文件</th>
									<th>模版</th>
									<th>代号</th>
									<th>客户端</th>
									<th>类型</th>
									<th>操作</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($data as $key=>$val){
								?>
								<tr>
									<td><?=$key+1?></td>
									<td><?=$val->filedir?></td>
									<td><?=$val->filename?></td>
									<td><?=$val->tpl_url?></td>
									<td><?=$val->code?></td>
									<td><?=$ch['client'][$val->client]?></td>
									<td><?=$ch['type'][$val->type]?></td>
									<td>
										<a class="btn btn-primary btn-sm" href="/build/preview?id=<?=$val->id?>" />预览</a>
										<a class="btn btn-warning btn-sm" href="/build/onenode?id=<?=$val->id?>" />生成</a>
									</td>
								</tr>
								<?php
								}
								?>
							</tbody>
							</table>
						</div>
					</div>
					<?= CusSystem::getPageHtml($pagination) ?>
				</div>

			</div>
		</div>
    </div>
</section>