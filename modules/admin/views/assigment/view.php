<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\JsExpression;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var mdm\admin\models\AssigmentSearch $searchModel
 */
$this->title = 'Assigments';
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->menus;
$route = $controller->route;
$items = [];
foreach ($menus as $menu) {
	$active = strpos($route, trim($menu['url'][0], '/')) === 0 ? ' active' : '';
	if (strpos($route, trim($menu['url'][0], '/')) === 0) $this->title=$menu['label'];
	$items[] = ['label'=>$menu['label'],'icon'=>'link','url'=>$menu['url'],'options'=>['class'=>$active]];
}
$this->params['sideMenu']=$items;
?>
<?php $this->beginContent('@hscstudio/heart/views/layouts/column2module.php'); ?>
<div class="assigment-index">
    <h1>User: <?= $model->{$usernameField} ?></h1>

    <div class="col-lg-5">
        Avaliable: 
        <?php
        echo Html::textInput('search_av', '', ['class' => 'role-search', 'data-target' => 'avaliable']) . '<br>';
        echo Html::listBox('roles', '', $avaliable, [
            'id' => 'avaliable',
            'multiple' => true,
            'size' => 20,
            'style' => 'width:100%']);
        ?>
    </div>
    <div class="col-lg-1">
        &nbsp;<br><br>
        <?php
        echo Html::a('>>', '#', ['class' => 'btn btn-success', 'data-action' => 'assign']) . '<br>';
        echo Html::a('<<', '#', ['class' => 'btn btn-success', 'data-action' => 'delete']) . '<br>';
        ?>
    </div>
    <div class="col-lg-5">
        Assigned: 
        <?php
        echo Html::textInput('search_asgn', '', ['class' => 'role-search', 'data-target' => 'assigned']) . '<br>';
        echo Html::listBox('roles', '', $assigned, [
            'id' => 'assigned',
            'multiple' => true,
            'size' => 20,
            'style' => 'width:100%']);
        ?>
    </div>
</div>
<?php
$this->render('_script',['id'=>$model->{$idField}]);
$this->endContent();
