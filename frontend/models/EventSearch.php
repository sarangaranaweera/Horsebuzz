<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Event;
use common\models\Checkin;

/**
 * EventSearch represents the model behind the search form about `common\models\Event`.
 */
class EventSearch extends Event
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'created_by', 'updated_by'], 'integer'],
            [['title', 'organiser_id', 'interest_id', 'description', 'location', 'created_date', 'updated_date'], 'safe'],
            [['is_active'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Event::find()-> where(['organiser_id'=>Yii::$app->user->identity->id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'start_date' => SORT_ASC,
                ]
            ],
        ]);

        $query->joinWith(['interest']);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }



        $query->andFilterWhere([
            'id' => $this->id,
            'organiser_id' => $this->organiser_id,

            'is_active' => $this->is_active,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'location', $this->location]);
        $query->andFilterWhere(['like', 'area_intrest', $this->interest_id]);

        return $dataProvider;
    }

    public static function showCheckin($id)
    {
        $checkin = Checkin::find()
                ->where('event_id='.$id)
                ->count();

        return '<span class="label label-danger">'.$checkin.'</span>';
    }

}
