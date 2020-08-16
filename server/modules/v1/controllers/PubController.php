<?php

namespace app\modules\v1\controllers;

use app\controllers\BaseActiveController;
use app\modules\v1\models\Pub;
use app\modules\v1\services\PubService;

/**
 * @SWG\Get(path="/pubs",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для получения списка баров",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
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
 * @SWG\Get(path="/pubs/{id}",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для получения конкретного бара",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Идентификатор бара",
 *        required = true,
 *        type = "integer"
 *     ),
 * 
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Post(path="/pubs",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для создания бара",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "name",
 *        description = "Название бара",
 *        required = true,
 *        type = "string"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "playing_music",
 *        description = "Идентификатор жанра музыки играющей в баре",
 *        required = true,
 *        type = "integer"
 *     ),
 * 
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Put(path="/pubs/{id}",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для обновления бара",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Идентификатор бара",
 *        required = true,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "name",
 *        description = "Название бара",
 *        required = false,
 *        type = "string"
 *     ),
 *     @SWG\Parameter(
 *        in = "formData",
 *        name = "playing_music",
 *        description = "Идентификатор жанра музыки играющей в баре",
 *        required = false,
 *        type = "integer"
 *     ),
 * 
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Delete(path="/pubs/{id}",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для удаления бара",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Идентификатор бара",
 *        required = true,
 *        type = "integer"
 *     ),
 *
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Get(path="/pubs/order-pub-music/pub/{pub_id}/music/{music_id}",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для заказа музыки в баре",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "pub_id",
 *        description = "Идентификатор бара",
 *        required = true,
 *        type = "integer"
 *     ),
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "music_id",
 *        description = "Идентификатор жанра музыки",
 *        required = true,
 *        type = "integer"
 *     ),
 *     
 *     @SWG\Response(
 *         response = 200,
 *         description = "success"
 *     )
 * )
 * @SWG\Get(path="/pubs/fetch-pub-state/pub/{pub_id}",
 *     tags={"pub"},
 *     summary="Подробней",
 *     description="Метод для получения состояния бара",
 *     produces={"application/json"},
 *     security={{"Bearer":{}}},
 *     @SWG\Parameter(
 *        in = "path",
 *        name = "pub_id",
 *        description = "Идентификатор бара",
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
class PubController extends BaseActiveController
{
    public $modelClass = Pub::class;
    private $pubService;

    public function __construct($id, $module, $config = [], PubService $pubService)
    {
        $this->pubService = $pubService;
        parent::__construct($id, $module, $config);
    }

    public function actionFetchPubState($pub_id)
    {
        return $this->pubService->getPubState($pub_id);
    }

    public function actionOrderPubMusic($pub_id, $music_id)
    {
        return $this->pubService->cnahgePubMusic($pub_id, $music_id);
    }
}
