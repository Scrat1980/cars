<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property integer $id
 * @property string $brand
 * @property string $model
 * @property string $equipment
 * @property integer $power
 * @property string $color
 * @property string $photo
 * @property integer $price
 * @property string $status
 */
class Car extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['power', 'price'], 'integer'],
            [['brand', 'model', 'equipment', 'color', 'photo', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Марка',
            'model' => 'Модель',
            'equipment' => 'Комплектация',
            'power' => 'Мощность',
            'color' => 'Цвет',
            'photo' => 'Фото',
            'price' => 'Цена',
            'status' => 'Статус'
        ];
    }
}
