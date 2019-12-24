<?php


namespace app\components;


use yii\base\Exception;

class RecordNotFoundException extends Exception
{
    protected $code = 404;
    protected $message = 'RecordNotFound';
}