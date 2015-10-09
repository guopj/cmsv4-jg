<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<section class="content-header">
    <h1>
        结点设置<small>生成按结点进行</small>
    </h1>
</section>
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
					
					<div>
						<label>
							客户端
							<select aria-controls="example1">
								<option value="10">PC版</option>
								<option value="25">M版</option>
							</select>
						</label>
						<label>
							节点名:
							<input aria-controls="example1">
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
									<th>目录</th>
									<th>文件</th>
									<th>模版</th>
									<th>代号</th>
									<th>客户端</th>
									<th>类型</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Gecko</td>
									<td>Firefox 1.0</td>
									<td>Win 98+ / OSX.2+</td>
									<td>1.7</td>
									<td>A</td>
									<td>A</td>
								</tr>
								<tr>
									<td>Gecko</td>
									<td>Firefox 1.0</td>
									<td>Win 98+ / OSX.2+</td>
									<td>1.7</td>
									<td>A</td>
									<td>A</td>
								</tr>
								<tr>
									<td>Gecko</td>
									<td>Firefox 1.0</td>
									<td>Win 98+ / OSX.2+</td>
									<td>1.7</td>
									<td>A</td>
									<td>A</td>
								</tr>							
							</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-5">
							<div class="dataTables_info">一共有500条数据</div>
						</div>
						<div class="col-sm-7">
							<div class="dataTables_paginate paging_simple_numbers" style="float:right">
								<ul class="pagination">
									<li id="example2_previous" class="paginate_button previous disabled">
										<a href="#">上一页</a>
									</li>
									<li class="paginate_button active">
										<a href="#" >1</a>
									</li>
									<li class="paginate_button ">
										<a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0">2</a>
									</li>
									<li class="paginate_button ">
										<a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0">3</a>
									</li>
									<li id="example2_next" class="paginate_button next">
										<a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0">下一页</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
    </div>
</section>