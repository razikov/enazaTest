<?php

namespace app\modules\v1\services;

use app\modules\v1\models\Client;
use app\modules\v1\models\Pub;
use Throwable;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

class PubService
{
    public function getPubState($pub_id)
    {
        $model = Pub::findOne($pub_id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        return [
            'playingMusic' => Pub::getListMusics()[$model->playing_music] ?? '',
            'drinkingClientCount' => $model->getDrinkingClient()->count(),
            'dancingClientCount' => $model->getDancingClient()->count(),
        ];
    }

    public function cnahgePubMusic($pub_id, $music_id)
    {
        $model = Pub::findOne($pub_id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->load(['playing_music' => $music_id], '');

        $transaction = \Yii::$app->db->beginTransaction();

        try {
            if ($model->save() === false && !$model->hasErrors()) {
                throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
            }

            $clientsTable = Client::tableName();
            $locationBar = Pub::LOCATION_BAR;
            $locationDance = Pub::LOCATION_DANCE_PLACE;
            $playingMusic = intval($model->playing_music);
            $pubId = intval($model->id);
            \Yii::$app->db->createCommand(
                "UPDATE {$clientsTable} 
                SET location = CASE love_music WHEN {$playingMusic} THEN {$locationDance} ELSE {$locationBar} END 
                WHERE pub_id = {$pubId};"
            )->execute();

            $transaction->commit();
        } catch (Throwable $e) {
            $transaction->rollback();
            throw new ServerErrorHttpException($e);
        }

        return $model;
    }
}