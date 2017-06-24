<?php

namespace app\controllers;

use Yii;
use app\models\Car;
use app\models\CarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $model = new Car();
        $brands = Car::find()
            ->select('brand')
            ->distinct()
            ->all()
        ;

        $quantity = Car::find()
            ->distinct()
            ->count()
            ;

        return $this->render('index', [
            'model' => $model,
            'brands' => $brands,
            'quantity' => $quantity
        ]);
    }


}
