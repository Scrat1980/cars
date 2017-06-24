<?php

namespace app\controllers;

use Yii;
use app\models\Car;
use app\models\CarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * CarController implements the CRUD actions for Car model.
 */
class CarController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Car models.
     * @return mixed
     */
    public function actionIndex()
    {
        $updateUrl = Url::to(['car/update']);
        
        $model = new Car();

        $brandsList = $this->getOptionsList( 'brand' );
        $modelsList = $this->getOptionsList( 'model' );
        $powersList = $this->getOptionsList( 'power' );

        $quantity = Car::find()
//            ->distinct()
            ->count()
            ;

        return $this->render('index', [
            'url' => $updateUrl,
            'model' => $model,
            'modelsList' => $modelsList,
            'brandsList' => $brandsList,
            'powersList' => $powersList,
            'quantity' => $quantity
        ]);
    }

    private function getOptionsList( $field )
    {
        $options = Car::find()
            ->select( $field )
            ->distinct()
            ->all()
        ;

        $optionsList = ['*' => 'Все'];
        foreach ( $options as $option ) {
            $optionHtml = $option->{$field};
            $optionsList[$optionHtml] = $optionHtml;
        }

        return $optionsList;
    }

    public function actionUpdate( $brand, $model, $power )
    {

        $car = new Car();

        $whereFilters = ['and'];

        $whereFilters = $this->addFilter(
            'brand',
            $brand,
            $whereFilters
        );

        $whereFilters = $this->addFilter(
            'model',
            $model,
            $whereFilters
        );

        $whereFilters = $this->addFilter(
            'power',
            $power,
            $whereFilters
        );

        $quantity = $car->find()
            ->where( $whereFilters )
//            ->distinct()
            ->count()
        ;

        return json_encode([
//            'modelsList' => $modelsList,
            'quantity' => $quantity,
        ]);
    }

    private function addFilter( $field, $value, $filter )
    {
        if( $value !== '*' ) {
            $filter[] = ['=', $field, $value];
        }

        return $filter;
    }


}
