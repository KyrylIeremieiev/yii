<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kristal".
 *
 * @property int|null $order_item_id
 * @property string|null $order_item_name
 * @property string|null $order_item_type
 * @property int|null $order_id
 */
class Kristal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kristal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_item_id'], 'integer'],
            [['order_item_name'], 'string'],
            [['order_item_type'], 'string', 'max' => 200],
            [['order_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_item_id' => 'Order Item ID',
            'order_item_name' => 'Order Item Name',
            'order_item_type' => 'Order Item Type',
            'order_id' => 'Order ID',
        ];
    }
}
