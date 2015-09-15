<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

/**
 * Profile form
 */
class ProfileForm extends Model
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            [['username','description'], 'required'],
            ['clubname', 'required'],
            ['address', 'required'],
            ['mobilenumber', 'required'],
            ['phonenumber', 'integer'],
            ['mobilenumber', 'integer'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['description', 'string', 'min' => 2, 'max' => 255],
            ['firstname','string','max'=> 255],
            ['lastname','string','max'=> 255],

            [['file'], 'file', 'extensions'=>'jpg, gif, png'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],


            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'file' => 'Image/Logo',
            'password_repeat' => 'Confirm Password',
            'address' => 'Address',
            'username' => 'Username',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'clubname' => 'Club Name',
            'phonenumber' => 'Phone Number',
            'mobilenumber' => 'Mobile Number',
            'dateofbirth' => 'Date Of Birth',
            'description' => 'Description',
            'email' => 'Email',
        ];
    }

    public function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
