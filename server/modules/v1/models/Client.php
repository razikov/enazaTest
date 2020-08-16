<?php

namespace app\modules\v1\models;

use yii\db\ActiveRecord;
use Yii;

/**
 * @property $id
 * @property $name
 * @property $love_music
 * @property $location
 * @property $pub_id
 */
class Client extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%clients}}';
    }

    public function rules()
    {
        return [
            [['love_music', 'location', 'pub_id'], 'required'],
            [['name'], 'string'],
            [['love_music'], 'in', 'range' => array_keys(Pub::getListMusics())],
            [['location'], 'in', 'range' => array_keys(Pub::getListLocations())],
            [['pub_id'], 'exist', 'targetClass' => Pub::class, 'targetAttribute' => 'id'],
            [['name', 'love_music', 'location', 'pub_id'], 'safe']
        ];
    }
    
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '#'),
            'name' => Yii::t('app', 'name'),
            'love_music' => Yii::t('app', 'love_music'),
            'location' => Yii::t('app', 'location'),
            'pub_id' => Yii::t('app', 'pub_id'),
        ];
    }
    
    public function getPub()
    {
        return $this->hasOne(Pub::class, ['id' => 'pub_id']);
    }
    
    public function extraFields()
    {
        return [
            'loveMusicName',
            'locationName',
        ];
    }
    
    public function getLoveMusicName()
    {
        return Pub::getListMusics()[$this->love_music];
    }
    
    public function getLocationName()
    {
        return Pub::getListLocations()[$this->location];
    }
}
