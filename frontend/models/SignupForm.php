<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $firstname;
    public $lastname;
    public $phonenumber;
    public $mobilenumber;
    public $dateofbirth;
    public $clubname;
    public $address;
    public $description;
    public $email;
    public $image;
    public $password;
    public $file;
    public $password_repeat;


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


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {

            $user = new User();
            $model = new SignupForm();

            $user->firstname = $this->firstname;
            $user->lastname = $this->lastname;
            $user->clubname = $this->clubname;
            $user->phonenumber = $this->phonenumber;
            $user->mobilenumber = $this->mobilenumber;
            $user->dateofbirth = $this->dateofbirth;
            $user->address = $this->address;
            $user->description = $this->description;
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->file) {
                $model->file->saveAs('uploads/' . $model->file->name);
                $user->image = $model->file->name;
            }
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
        return null;
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
