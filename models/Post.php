<?php


namespace app\models;


use yii\db\ActiveQueryInterface;
use yii\mongodb\ActiveRecord;


/**
 * Class Post
 * @package app\models
 *
 * @property $_id
 * @property $placeId
 * @property $userId
 * @property $text
 * @property $status
 * @property $createdAt
 *
 * @property $user User
 * @property $place Place
 */
class Post extends ActiveRecord
{
    /**
     * @return string the name of the index associated with this ActiveRecord class.
     */
    public static function collectionName(): string
    {
        return 'posts';
    }

    /**
     * @return array list of attribute names.
     */
    public function attributes(): array
    {
        return ['_id', 'placeId', 'userId', 'text', 'status', 'createdAt'];
    }

    /**
     * @return array
     */
    public function fields(): array
    {
        return [
            'id' => '_id',
            'user' => function () {
                return $this->user;
            },
            'place' => function () {
                return $this->place;
            },
            'text',
            'timePassed' => function() {
                return time() - $this->createdAt;
            },
        ];
    }

    /**
     * @return ActiveQueryInterface
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['_id' => 'userId']);
    }

    /**
     * @return ActiveQueryInterface
     */
    public function getPlace()
    {
        return $this->hasOne(Place::class, ['_id' => 'placeId']);
    }
}