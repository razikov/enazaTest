<?php

namespace app\modules\v1\models;

use yii\data\ActiveDataProvider;

class ClientSearch extends Client
{

    public function rules()
    {
        return [
            [['location', 'pub_id'], 'safe']
        ];
    }
    
    public function search($params)
    {
        $this->load($params, '');
        
        $query = Client::find();
        $query->andFilterWhere(['location' => $this->location]);
        $query->andFilterWhere(['pub_id' => $this->pub_id]);

        return new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
    }
}
