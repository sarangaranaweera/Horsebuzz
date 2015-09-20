<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $message
 * @property boolean $is_delivered
 * @property boolean $is_notified
 * @property boolean $is_deleted
 * @property string $created_date
 * @property string $updated_date
 * @property boolean $is_group
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sender_id', 'receiver_id'], 'integer'],
            [['message'], 'string'],
            [['is_delivered', 'is_notified', 'is_deleted', 'is_group'], 'boolean'],
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
            'sender_id' => 'Sender ID',
            'receiver_id' => 'Receiver ID',
            'message' => 'Message',
            'is_delivered' => 'Is Delivered',
            'is_notified' => 'Is Notified',
            'is_deleted' => 'Is Deleted',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'is_group' => 'Is Group',
        ];
    }
}
