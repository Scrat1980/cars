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

    $form = ActiveForm::begin(['action' => $url]);
    echo $form->field( $model, 'brand' )->dropDownList($brandsList);
    echo $form->field( $model, 'model' )->dropDownList($modelsList);
    echo $form->field( $model, 'power' )->dropDownList($powersList);
    echo "Остаток автомобилей - <span id='quantity'>$quantity</span> шт.";
    ActiveForm::end();

    ?>


</div>
