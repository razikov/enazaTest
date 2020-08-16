<?php

namespace app\modules\v1\controllers;

use app\modules\v1\models\Client;
use app\controllers\BaseActiveController;

/**
 * @SWG\Get(path="/clients",
 *     tags={"client"},
 *     summary="Подробней",
 *     description="Метод для получения списка клиентов",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "query",
 *        name = "location",
 *        description = "Идентификатор положения клиента",
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "query",
 *        name = "page",
 *        description = "Параметр указывающих какую страницу получить",
 *        type = "integer"
 *     ),
 * 
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Get(path="/clients/{id}",
 *     tags={"client"},
 *     summary="Подробней",
 *     description="Метод для получения клиента по идентификатору",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Идентификатор клиента",
 *        required = true,
 *        type = "integer"
 *     ),
 *
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Post(path="/clients",
 *     tags={"client"},
 *     summary="Подробней",
 *     description="Метод для создания клиента",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "name",
 *        description = "Имя клиента",
 *        required = true,
 *        type = "string"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "love_music",
 *        description = "Идентификатор жанра музыки",
 *        required = true,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "location",
 *        description = "Идентификатор положения клиента",
 *        required = true,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "pub_id",
 *        description = "Идентификатор бара",
 *        required = true,
 *        type = "integer"
 *     ),
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Put(path="/clients/{id}",
 *     tags={"client"},
 *     summary="Подробней",
 *     description="desc client",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Идентификатор клиента",
 *        required = true,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "name",
 *        description = "Имя клиента",
 *        required = false,
 *        type = "string"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "love_music",
 *        description = "Идентификатор жанра музыки",
 *        required = false,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "location",
 *        description = "Идентификатор положения клиента",
 *        required = false,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "pub_id",
 *        description = "Идентификатор бара",
 *        required = false,
 *        type = "integer"
 *     ),
 *
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Delete(path="/clients/{id}",
 *     tags={"client"},
 *     summary="Подробней",
 *     description="Метод для удаления клиента",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Идентификатор клиента",
 *        required = true,
 *        type = "integer"
 *     ),
 *
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 */
class ClientController extends BaseActiveController
{
    public $modelClass = Client::class;
    
    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        
        return $actions;
    }
    
    public function prepareDataProvider()
    {
        $searchModel = new \app\modules\v1\models\ClientSearch();
        return $searchModel->search(\Yii::$app->request->queryParams);
    }
}
