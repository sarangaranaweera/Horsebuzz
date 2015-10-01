<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property integer $organiser_id
 * @property integer $interest_id
 * @property string $title
 * @property string $description
 * @property string $location
 * @property boolean $is_active
 * @property string $eeopen_date
 * @property string $eopen_date
 * @property string $eclose_date
 * @property string $start_date
 * @property string $end_date
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property Organiser $organiser
 * @property Areainterest $interest
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $cnt;

    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['organiser_id', 'interest_id', 'title', 'description', 'location', 'start_date', 'end_date', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['organiser_id', 'interest_id', 'created_by', 'updated_by'], 'integer'],
            [['is_active'], 'boolean'],
            [['eeopen_date', 'eopen_date', 'eclose_date', 'start_date', 'end_date', 'created_date', 'updated_date'], 'safe'],
            [['title', 'location'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 500]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'organiser_id' => 'Organiser ID',
            'interest_id' => 'Event Type',
            'title' => 'Event Title',
            'description' => 'Description',
            'location' => 'Location',
            'address' => 'Location',
            'is_active' => 'Activate Event',
            'eeopen_date' => 'Early Entries Open Date and Time',
            'eopen_date' => 'Entries Open Date and Time',
            'eclose_date' => 'Entries Close Date and Time',
            'start_date' => 'Event Start Date',
            'end_date' => 'Event End Date',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganiser()
    {
        return $this->hasOne(User::className(), ['organiser_id' => 'organiser_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInterest()
    {
        return $this->hasOne(Areaintrest::className(), ['id' => 'interest_id']);
    }
}




