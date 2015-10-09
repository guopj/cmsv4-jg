<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<section class="content-header">
    <h1>
        内容查看<small></small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
					<p>
						<a class="btn btn-success" href="#">添加内容</a>
					</p>
                </div>
                <div class="box-body">
					<div class="row">
						<div class="col-sm-12">
						
						<?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $model,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute'=>'tag',
                                ],
                                [
                                    'attribute'=>'title',
                                ],
                                [
                                    'attribute'=>'title_sub',
                                    //'options'=>['width'=>'30%']
                                ],
                                /*
								[
                                    'attribute'=>'img',
                                ],
								*/
                                [
                                    'header' => "操作",
                                    'value' => function ($model, $index, $widget) {
										return 
										'<a href="javascript:;" class="btn btn-xs btn-success">操作1</a> ' .
										'<a href="javascript:;" class="btn btn-xs btn-success">操作2</a>';
									},
                                    'format' => 'raw',
                                ],
                            ],

                        ]); 
						?>
						
						</div>
					</div>
					
					<!-- 正确的表格样式
					<div class="row">	
						<div class="col-sm-12">
							<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
							<thead>
								<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Rendering engine</th>
									<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Browser</th>
									<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Platform(s)</th>
									<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Engine version</th>
									<th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending">CSS grade</th>
								</tr>
							</thead>
							<tbody>
								<tr class="odd" role="row">
									<td class="sorting_1">Gecko</td>
									<td>Firefox 1.0</td>
									<td>Win 98+ / OSX.2+</td>
									<td>1.7</td>
									<td>A</td>
								</tr>
								<tr class="odd" role="row">
									<td class="sorting_1">Gecko</td>
									<td>Firefox 1.0</td>
									<td>Win 98+ / OSX.2+</td>
									<td>1.7</td>
									<td>A</td>
								</tr>
								<tr class="odd" role="row">
									<td class="sorting_1">Gecko</td>
									<td>Firefox 1.0</td>
									<td>Win 98+ / OSX.2+</td>
									<td>1.7</td>
									<td>A</td>
								</tr>							
							</tbody>
							</table>
						</div>
					</div>
					-->
				</div>
			</div>
		</div>
    </div>
</section>