<?php

namespace app\actions;

class ErrorAction extends \yii\web\ErrorAction
{
    public function run(): string
    {
        \Yii::$app->getResponse()->setStatusCodeByException($this->exception);
        return $this->findException();
    }
}
