<?php

namespace app\commands;

use yii\console\Controller;
use app\modules\v1\models\Pub;
use app\modules\v1\models\Client;
use Faker\Factory;

class DataController extends Controller
{
    private $pubsTable;
    private $clientsTable;

    public function __construct($id, $module, $config = [])
    {
        $this->pubsTable = Pub::tableName();
        $this->clientsTable = Client::tableName();
        parent::__construct($id, $module, $config);
    }

    public function actionInit()
    {
        $sql = "TRUNCATE TABLE {$this->clientsTable}";
        \Yii::$app->db->createCommand($sql)->execute();
        $sql = "SET FOREIGN_KEY_CHECKS = 0;TRUNCATE TABLE {$this->pubsTable};SET FOREIGN_KEY_CHECKS = 1;";
        \Yii::$app->db->createCommand($sql)->execute();

        $faker = Factory::create('ru_RU');
        $pubId = 1;
        $pubPlayingMusic = $faker->randomElement(array_keys(Pub::getListMusics()));
        $sql = "INSERT INTO {$this->pubsTable}(id,name,playing_music) VALUES ({$pubId}, 'Пинта', {$pubPlayingMusic})";
        \Yii::$app->db->createCommand($sql)->execute();
        
        $n = 100000;
        $pub = Pub::findOne($pubId);
        if ($pub === null) {
            return false;
        }
        $rows = [];
        foreach (range(1, $n) as $i) {
            $loveMusic = $faker->randomElement(array_keys(Pub::getListMusics()));
            $location = ($loveMusic === $pubPlayingMusic) ? Pub::LOCATION_DANCE_PLACE : Pub::LOCATION_BAR;
            $rows[] = sprintf("(%s,'%s',%s,%s,%s)", $i, $faker->name, $loveMusic, $location, $pubId);
        }
        $rowsSql = implode(',', $rows);
        $sql = "INSERT INTO {$this->clientsTable}(id,name,love_music,location,pub_id) VALUES $rowsSql";
        \Yii::$app->db->createCommand($sql)->execute();
    }
}
