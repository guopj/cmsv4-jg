<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<section class="content-header">
    <h1>
        站点列表
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">

                </div>
                <div class="box-body">
                    <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel'  => $model,
                            'columns' => [
                                [
                                    'attribute'=>'name',
                                    'options'=>['width'=>'20%']
                                ],
								
                                [
                                    'attribute'=>'pc_domain',
                                    'options'=>['width'=>'30%']
                                ],
                                [
                                    'attribute'=>'m_domain',
                                    'options'=>['width'=>'30%']
                                ],
                                [
                                    'header' => "操作",
                                    'value' => function ($model, $index, $widget) {
                                            {
                                                return Html::a("编辑", ['update','id'=>$model->id], ['class' => 'btn btn-xs btn-success']) .
												' <a class="btn btn-xs btn-warning " href="javascript:;" name="usesite" site_name="' . $model->name . '" site_id="' . $model->id . '">使用</a>';
                                            }
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
</section>

<script type="text/javascript">
$(document).ready(function(){
	$("a[name = 'usesite']").click(function(){
		var site_id = $(this).attr('site_id');
		var site_name = $(this).attr('site_name');
		//alert(site_id);
		
		var data = "action=select&id=" + site_id; 
		if (confirm("确定使用站点 " + site_name)) {
			$.ajax({ 
				type: "POST" ,
				url: "/ajax/site", 
				data: data ,
				contentType: "application/x-www-form-urlencoded; charset=UTF-8",
				success: function(res){
					var res = eval("("+res+")");
					if(res.status == 1){
						alert('切换成功');
						window.location.reload();
					}else{
						alert(res.message);
					}
				}
			});		
		}		
	});
});
</script>

