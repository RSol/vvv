<?php

namespace app\modules\v1\controllers;

use app\components\RecordNotFoundException;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = Post::class;

    public function actions()
    {
        return [];
    }

    /**
     * @param $userId
     * @param int $offset
     * @param int $limit
     * @return array
     * @throws RecordNotFoundException
     */
    public function actionIndex($userId, $offset = 0, $limit = 20)
    {
//        new Dssfdfsdf();
        $posts = (new ActiveDataProvider(
            [
                'query' => Post::find()->where([
                    'userId' => $userId,
                ])
                    ->offset($offset)
                    ->limit($limit),
                'pagination' => false,
            ]
        ))->getModels();

        if (!$posts) {
            throw new RecordNotFoundException();
        }
        return [
            'posts' => $posts,
        ];
    }
}