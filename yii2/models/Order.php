<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $klantnaam
 * @property float $korting
 * @property string $valuta
 *
 * @property Product[] $products
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['klantnaam'], 'required'],
            [['korting'], 'number'],
            [['klantnaam'], 'string', 'max' => 255],
            [['valuta'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'klantnaam' => 'Klantnaam',
            'korting' => 'Korting',
            'valuta' => 'Valuta',
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
