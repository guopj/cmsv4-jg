<?php
use yii\bootstrap\ActiveForm;
$this->registerJsFile('/static/site/js/opt.js');
?>
<?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data'],'layout'=>'horizontal']); ?>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right">
        <li class=""><a data-toggle="tab" href="#m-info" aria-expanded="false">Mobile站点信息</a></li>
        <li class="active"><a data-toggle="tab" href="#pc-info" aria-expanded="true">PC站点信息</a></li>
    </ul>
    <div class="tab-content">
        <div id="pc-info" class="tab-pane active">
            <?= $form->field($model, 'name')->textInput(); ?>

            <?= $form->field($model, 'dir')->textInput(); ?>

            <?= $form->field($model, 'pc_domain')->textInput(); ?>

            <?= $form->field($model, 'root')->textInput(); ?>

            <?= $form->field($model, 'pc_static')->textInput(); ?>

            <?= $form->field($model, 'server')->dropDownList([0=>'woniu.com',1=>'snail.com']); ?>

            <?= $form->field($model, 'is_test')->dropDownList([0=>'正式',1=>'测试']); ?>

            <?= $form->field($model, 'is_publish')->dropDownList([0=>'发布',1=>'不发']); ?>

            <?= $form->field($model, 'sitemap')->dropDownList([0=>'禁止',1=>'允许']); ?>
        </div>
        <div id="m-info" class="tab-pane">
            <?= $form->field($model, 'm_domain')->textInput(); ?>

            <?= $form->field($model, 'm_static')->textInput(); ?>

        </div>
    </div>
</div>

<div class="box box-solid">
    <div class="box-footer">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-flat pull-right" type="submit">保存</button>
            </span>
        </div>
    </div>
</div>
<?php $form::end(); ?>