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
            [['brand', 'model', 'equipment', 'color', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'brand' => 'Brand',
            'model' => 'Model',
            'equipment' => 'Equipment',
            'power' => 'Power',
            'color' => 'Color',
            'photo' => 'Photo',
            'price' => 'Price',
        ];
    }
}
