<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "user_follow".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $organiser_id
 * @property boolean $is_follow
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 */
class UserFollow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_follow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'organiser_id', 'created_date', 'created_by', 'updated_date', 'updated_by'], 'required'],
            [['user_id', 'organiser_id', 'created_by', 'updated_by'], 'integer'],
            [['is_follow'], 'boolean'],
            [['created_date', 'updated_date'], 'safe']
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
            'organiser_id' => 'Organiser ID',
            'is_follow' => 'Is Follow',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    public function users()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id']);
    }
}
