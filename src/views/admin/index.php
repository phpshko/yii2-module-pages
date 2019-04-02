<?php
/**
 * @var $this \yii\web\View
 * @var $model \floor12\pages\models\PageFilter
 */


use floor12\editmodal\EditModalHelper;
use floor12\pages\assets\IconHelper;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = "Страницы";


echo Html::tag('h1', $this->title);


?>

    <div class="pull-right">
        <?php

        echo Html::a(IconHelper::PLUS . " " . Yii::t('app.f12.mailing', 'Add recipient'), null, [
                'onclick' => EditModalHelper::showForm(['/pages/page/form'], 0),
                'class' => 'btn btn-sm btn-default'
            ]) . " ";
        ?>
    </div>

<?php

$form = ActiveForm::begin([
    'enableClientValidation' => false,
    'method' => "GET",
    'options' => [
        'class' => 'table-mailing-autosubmit',
        'data-container' => '#items'
    ]]) ?>

    <div class="filter-block">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'filter')->label(false)->textInput(['placeholder' => Yii::t('app.f12.mailing', 'Filter...')]) ?>
            </div>
        </div>

    </div>

<?php ActiveForm::end();

Pjax::begin(['id' => 'items']);

echo GridView::widget([
    'dataProvider' => $model->dataProvider(),
    'tableOptions' => ['class' => 'table table-striped table-banners'],
    'layout' => "{items}\n{pager}\n{summary}",
    'columns' => [
        'id',
        'title',
        [
            'contentOptions' => ['style' => 'text-align:right'],
            'class' => \floor12\editmodal\EditModalColumn::class,
        ]
    ]
]);

Pjax::end();

