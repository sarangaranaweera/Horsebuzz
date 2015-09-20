<?php

namespace frontend\models;

use Yii;


/**
 * This is the model class for table "checkin".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $event_id
 * @property string $user_type
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property User $user
 * @property Event $event
 */
class Checkin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'checkin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'event_id', 'user_type', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['user_id', 'event_id', 'created_by', 'updated_by'], 'integer'],
            [['user_type'], 'string'],
            [['created_date', 'updated_date'], 'safe'],
            [['user_id', 'event_id'], 'unique', 'targetAttribute' => ['user_id', 'event_id'], 'message' => 'The combination of User ID and Event ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'event_id' => 'Event ID',
            'user_type' => 'User Type',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    public function getMessage(){
        return $this->hasOne(Message::className(), ['id' => 'user_id' ] ,[ 'id' => 'sender_id']);
    }
}
