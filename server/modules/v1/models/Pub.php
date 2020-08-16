<?php

namespace app\modules\v1\models;

use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * @property $id
 * @property $name
 * @property $playing_music
 */
class Pub extends ActiveRecord
{
    public const LOCATION_BAR = 1;
    public const LOCATION_DANCE_PLACE = 2;
    
    public const MUSIC_ROCK = 1;
    public const MUSIC_POP = 2;
    public const MUSIC_JAZZ = 3;
    public const MUSIC_BLUES = 4;
    public const MUSIC_FOLK = 5;

    public static function tableName()
    {
        return '{{%pubs}}';
    }
    
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['playing_music'], 'in', 'range' => array_keys(self::getListMusics())],
        ];
    }

    public function getClients()
    {
        return $this->hasMany(Client::class, ['pub_id' => 'id']);
    }

    public function getDrinkingClient()
    {
        return $this->hasMany(Client::class, ['pub_id' => 'id'])
            ->onCondition([Client::tableName() . '.location' => self::LOCATION_BAR]);
    }

    public function getDancingClient()
    {
        return $this->hasMany(Client::class, ['pub_id' => 'id'])
            ->onCondition([Client::tableName() . '.location' => self::LOCATION_DANCE_PLACE]);
    }

    public static function getListMusics()
    {
        return [
            self::MUSIC_ROCK => 'rock',
            self::MUSIC_POP => 'pop',
            self::MUSIC_JAZZ => 'jazz',
            self::MUSIC_BLUES => 'blues',
            self::MUSIC_FOLK => 'folk',
        ];
    }

    public static function getListLocations()
    {
        return [
            self::LOCATION_BAR => 'бар',
            self::LOCATION_DANCE_PLACE => 'танцпол',
        ];
    }
    
    public function extraFields()
    {
        return [
            'playingMusicName',
        ];
    }
    
    public function getPlayingMusicName()
    {
        return self::getListMusics()[$this->playing_music];
    }
}
