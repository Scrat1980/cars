<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cars';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="car-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $brandsList = ['Любой'];
    foreach ($brands as $brand) {
        $brandsList[] = $brand->brand;
//        var_dump($brand->brand);

    }

    $form = ActiveForm::begin();
    echo $form->field( $model, 'brand' )->dropDownList($brandsList);
    echo $form->field( $model, 'model' )->dropDownList([]);
    echo "Остаток автомобилей - $quantity шт.";

    ?>


</div>
