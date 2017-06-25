<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'SPA Сток новых автомобилей';
//$this->params['breadcrumbs'][] = $this->title;
?>

<div class="car-index">
    <div style="display: none" id="get-models-url" data-url="<?=$getModelsUrl?>">
    </div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $form = ActiveForm::begin(['action' => $url]);

    foreach ( $paramsList as $option => $optionsList) {
        echo $form->field( $model, $option )->dropDownList($paramsList[$option]);
    }

    echo "Остаток автомобилей - <span id='quantity'>$quantity</span> шт.";

    ActiveForm::end();

    ?>


</div>
