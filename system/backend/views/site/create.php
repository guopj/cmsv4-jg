<section class="content-header">
    <h1>
        创建新站点
        <small class="text-danger">站点目录即域名，请先确定站点域名！</small>
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