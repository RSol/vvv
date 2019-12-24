<?php


namespace app\components;


use Yii;
use yii\helpers\ArrayHelper;

class ExceptionHelper
{
    public static function getData($exception)
    {
        $messages = [
            RecordNotFoundException::class => [
                'status' => 'RecordNotFound',
                'message' => 'Запись не найдена',
                'data' => (object)[],
            ],
            404 => [
                'status' => 'UrlNotFound',
                'message' => 'URL не найден',
                'data' => (object)[],
            ],
        ];

        foreach (['type', 'statusCode'] as $key) {
            if (($key = ArrayHelper::getValue($exception, $key)) && ($message = ArrayHelper::getValue($messages, $key))) {
                Yii::$app->response->statusCode = 404;
                return $message;
            }
        }

        Yii::$app->response->statusCode = 500;
        return [
            'status' => 'GeneralInternalError',
            'message' => 'Произошла ошибка',
            'data' => (object)[],
        ];
    }

}