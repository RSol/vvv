<?php


namespace app\models;


use yii\mongodb\ActiveRecord;

/**
 * Class User
 * @package app\models
 *
 * @property $_id
 * @property $firstName
 * @property $secondName
 *
 */
class User extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName(): string
    {
        return 'users';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes(): array
    {
        return ['_id', 'firstName', 'secondName'];
    }

    public function fields()
    {
        return [
            'id' => '_id',
//            'user' => 'user',
//            'place' => 'place',
            'firstName',
//            'timePassed' => 'timePassed',
            'secondName',
        ];
    }
}