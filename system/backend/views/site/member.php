<?php
/**
 * Created by PhpStorm.
 * User: guopj
 * Date: 2015/10/8
 * Time: 17:20
 */


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
                        'dataProvider' => $data,
                        'filterModel'  => $model,
                        'columns' => [
                            /*
                            ['class' => 'yii\grid\SerialColumn'],
                            [
                                'attribute'=>'id',
                                'options'=>['width'=>'5%']
                            ],
                            */
                            [
                                'attribute'=>'id',
                                'options'=>['width'=>'6%']
                            ],

                            [
                                'attribute'=>'username',
                                'options'=>['width'=>'10%']
                            ],
                            [
                                'attribute'=>'realname',
                                'options'=>['width'=>'10%']
                            ],
                            [
                                'attribute'=>'role',
                                'options'=>['width'=>'10%']
                            ],
                            [
                                'header' => "操作",
                                'value' => function ($model, $index, $widget) {
                                    {
//                                        return Html::a("编辑", ['update','id'=>$model->id], ['class' => 'btn btn-xs btn-success']) .
//                                        ' <a class="btn btn-xs btn-warning " href="javascript:;" name="usesite" site_name="' . $model->name . '" site_id="' . $model->id . '">使用</a>';
                                        return Html::a("编辑", ['update','id'=>$model->id], ['class' => 'btn btn-xs btn-success']);
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