<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Car;
use yii\helpers\Url;


class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Lists all Car models.
     * @return mixed
     */
    public function actionIndex()
    {
        $carOptions = ['brand', 'model', 'equipment', 'power', 'color', 'price'];
        $paramsList = [];

        foreach ( $carOptions as $carOption) {
            $paramsList[$carOption] = $this->getOptionsList( $carOption );
        }

        $quantity = Car::find()
            ->count();

        $updateUrl = Url::to( ['site/update'] );
        $getModelsUrl = Url::to( ['site/get-models'] );
        $model = new Car();

        return $this->render('index', [
            'url' => $updateUrl,
            'getModelsUrl' => $getModelsUrl,
            'model' => $model,
            'paramsList' => $paramsList,
            'quantity' => $quantity
        ]);
    }

    public function actionUpdate( $data )
    {
        $filterConditions = json_decode( $data )[0];

        $whereFilters = ['and'];

        foreach ( $filterConditions as $key => $value) {
            if( $value === 'Все' ) {
                continue;
            }

            $integerFields = ['power', 'price'];
            if( in_array( $key, $integerFields ) && $value != 0 ) {
                $value = (int) $value;
            }

            $whereFilters = $this->addFilter(
                $key,
                $value,
                $whereFilters
            );

        }

        $car = new Car();
        $quantity = $car->find()
            ->where( $whereFilters )
            ->count()
        ;

        return $quantity;
    }

    public function actionGetModels( $brand )
    {
        $whereCondition = ( $brand === '*' )
            ? ''
            : ['brand' => $brand];

        $models = Car::find()
            ->select( 'model' )
            ->where( $whereCondition )
            ->all()
        ;

        $modelsList = ['*' => 'Все'];

        foreach ($models as $model) {
            $modelsList[] = $model->model;
        }

        return json_encode( $modelsList );
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

    private function addFilter( $field, $value, $filter )
    {
        if( $value !== '*' ) {
            $filter[] = ['=', $field, $value];
        }

        return $filter;
    }


}
