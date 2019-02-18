<?php
/**
 * Created by PhpStorm.
 * User: floor12
 * Date: 24.10.2016
 * Time: 20:22
 *
 * @var \floor12\pages\Page $model
 *
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use floor12\pages\Page;
use floor12\summernote\Summernote;

$form = ActiveForm::begin([
    'id' => 'page-form',
    'options' => ['class' => 'modaledit-form'],
    'enableClientValidation' => true
]);

if (Yii::$app->request->get('parent_id'))
    $model->parent_id = intval(Yii::$app->request->get('parent_id'));

?>
<div class="modal-header">
    <h2><?= $model->isNewRecord ? "Добавление страницы" : "Редактирование страницы"; ?></h2>
</div>
<div class="modal-body">
    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'title_menu')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'title_seo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'keywords_seo')->textarea(['rows' => 2]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description_seo')->textarea(['rows' => 2]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'key')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'parent_id')->dropDownList(Page::find()->select('title')->indexBy('id')->orderBy("parent_id, norder")->column(), ['prompt' => ['options' => ['value' => '0'], 'text' => 'Корень']]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'index_controller')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'index_action')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'index_params')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'view_controller')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'view_action')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'status')->checkbox() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'menu')->checkbox() ?>
        </div>
    </div>


    <?= $form->field($model, 'content')->widget(Summernote::className(), []) ?>
</div>
<div class="modal-footer">
    <?= Html::a('Отмена', '', ['class' => 'btn btn-default modaledit-disable']) ?>
    <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
