<section class="content-header">
    <h1>
        编辑站点
        <small class="text-danger">正式环境，请谨慎修改发布目录！</small>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?= $this->render('_form', [
                'model'    => $model
            ]) ?>
        </div>
    </div>
</section>