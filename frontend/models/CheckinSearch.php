<?php

namespace frontend\models;

use common\models\Users;
use Yii;
use Yii\db\Query;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Checkin;
use common\models\Event;


/**
 * CheckinSearch represents the model behind the search form about `common\models\Checkin`.
 */
class CheckinSearch extends Checkin
{

    public $fullName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_by', 'updated_by'], 'integer'],
            [['user_type', 'user_id', 'event_id', 'created_date', 'updated_date','fullName'], 'safe'],
            ['fullName', 'string', 'max' => 500],
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

        if(!isset($_GET['id'])){
            $id='';
        }
        else{
            $id=$_GET['id'];
        }

        $query = Checkin::find()->where(['event_id'=> $id]);

        $query->joinWith(['event', 'users']);


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
            'updated_date' => $this->updated_date,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'event.title', $this->event_id]);

        $query->andFilterWhere(['or',
            ['like','user.firstname',$this->fullName],
            ['like','user.lastname',$this->fullName]]);
        //$query->andFilterWhere(['like', 'user.firstname', $this->fullName],['like', 'user.lastnam', $this->fullName]);
        $query->andFilterWhere(['like', 'user.email', $this->user_id]);
        $query->andFilterWhere(['like', 'user_type', $this->user_type]);



        return $dataProvider;
    }

    public function searchUsers($uid)
    {
        //echo $eid.'-'.$uid; die();
       // echo \Yii::$app->user->identity->id; die();
        $query = new Query;
        $query  ->select(['user.id','user.firstname','event.title'])  
                ->from('event')
                ->where(['event.organiser_id' => $uid])
                ->distinct()
                ->join( 'JOIN', 
                        'checkin',
                        'event.id = checkin.event_id'
                    )
                ->join( 'LEFT JOIN',
                         'user',
                         'checkin.user_id = user.id'); 
        


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;
        
    }
}
