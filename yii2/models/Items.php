<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Items".
 *
 * @property int $order_item_id
 * @property string $order_item_name
 * @property string $order_item_type
 * @property int $order_id
 *
 * @property Product[] $products
 */
class Items extends \yii\db\ActiveRecord
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
            [['order_item_id'], 'number','required'],
            [['order_item_name'], 'string', 'max' => 255],
            [['order_item_type'], 'string', 'max' => 255],
            [['order_id'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'order_item_id' => 'Item ID',
            'order_item_name' => 'Name',
            'order_item_type' => 'Type',
            'order_id' => 'Order ID',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['order_id' => 'id']);
    }
}
