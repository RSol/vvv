<?php


namespace app\models;


use yii\mongodb\ActiveRecord;

/**
 * Class Place
 * @package app\models
 *
 * @property $_id
 * @property $name
 * @property $city
 * @property $street
 * @property $category
 */
class Place extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName(): string
    {
        return 'places';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes(): array
    {
        return ['_id', 'name', 'city', 'street', 'category'];
    }

    public function fields()
    {
        return [
            'id' => '_id',
            'name',
            'city',
            'street',
            'category',
        ];
    }
}