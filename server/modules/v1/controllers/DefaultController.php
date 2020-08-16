<?php

namespace app\modules\v1\controllers;

use yii\rest\Controller;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'doc' => [
                'class' => 'light\swagger\SwaggerAction',
                'restUrl' => \yii\helpers\Url::to(['/api/v1/api'], true),
            ],
            //The resultUrl action.
            'api' => [
                'class' => 'light\swagger\SwaggerApiAction',
                //The scan directories, you should use real path there.
                'scanDir' => [
                    \Yii::getAlias('@app/modules/v1/swagger'),
                    \Yii::getAlias('@app/modules/v1/controllers'),
                    \Yii::getAlias('@app/modules/v1/models'),
                ],
            ],
        ];
    }
}
