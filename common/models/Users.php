<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $dob
 * @property string $gender
 * @property string $device_token
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $role
 * @property string $mood_message
 * @property string $area_intrest
 * @property string $about_me
 * @property boolean $is_active
 * @property boolean $is_deleted
 * @property boolean $app_status
 * @property boolean $otp
 * @property string $created_date
 * @property integer $created_by
 * @property string $updated_date
 * @property integer $updated_by
 *
 * @property Checkin[] $checkins
 * @property Notification[] $notifications
 * @property NotificationRead[] $notificationReads
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dob', 'created_date', 'updated_date'], 'safe'],
            [['gender', 'role', 'about_me'], 'string'],
            [['role', 'area_intrest'], 'required'],
            [['is_active', 'is_deleted', 'app_status', 'otp'], 'boolean'],
            [['created_by', 'updated_by'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 255],
            [['device_token', 'mood_message'], 'string', 'max' => 500],
            [['email', 'username', 'password'], 'string', 'max' => 100],
            [['area_intrest'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullName'=>Yii::t('app', 'Full Name'),
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'device_token' => 'Device Token',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role',
            'mood_message' => 'Mood Message',
            'area_intrest' => 'Area Intrest',
            'about_me' => 'About Me',
            'is_active' => 'Is Active',
            'is_deleted' => 'Is Deleted',
            'app_status' => 'App Status',
            'otp' => 'Otp',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCheckins()
    {
        return $this->hasMany(Checkin::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotifications()
    {
        return $this->hasMany(Notification::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificationReads()
    {
        return $this->hasMany(NotificationRead::className(), ['user_id' => 'id']);
    }

    public function getFullName() {
        return $this->firstname . ' ' . $this->lastname;
    }
}
