<?php

namespace app\controllers;

use app\actions\ErrorAction;
use yii\rest\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }
}
