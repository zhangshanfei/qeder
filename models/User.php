<?php
namespace app\models;

use yii\db\ActiveRecord;
use Yii;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $repass;
    public $oldpass;
    public $rememberMe =true;
    public static function tableName()
    {
        return "{{%user}}";
    }

    public function rules()
    {
        return [
            //['openid', 'required', 'message' => 'openid不能为空', 'on' => ['']],
            //['username', 'required', 'message' => '用户名不能为空', 'on' => ['reg', 'regbymail']],
            //['openid', 'unique', 'message' => 'openid已经被注册', 'on' => ['']],
            //['username', 'unique', 'message' => '用户已经被注册', 'on' => ['reg', 'regbymail']],
            ['useremail', 'required', 'on' => ['reg', 'regbymail','login','seekpass']],
            ['useremail', 'email', 'on' => ['reg', 'regbymail','login','seekpass']],
            ['useremail', 'unique', 'on' => ['reg', 'regbymail']],
            ['useremail', 'validateEmail', 'on' => ['seekpass']],
            ['userpass', 'required', 'on' => ['reg', 'login', 'regbymail','changepass','forget']],
            ['repass', 'required', 'on' => ['reg', 'qqreg','changepass','regbymail','forget']],
            ['repass', 'compare', 'compareAttribute' => 'userpass','on' => ['reg','changepass','regbymail','forget']],
            ['userpass', 'validatePass', 'on' => ['login']],
            ['oldpass', 'required', 'on' => ['changepass']],
        ];
    }
   
	
    public function validatePass()
    {
        if (!$this->hasErrors()) {
            $data = self::find()->where('useremail = :email', [':email' => $this->useremail])->one();
            if (is_null($data)) {
                $this->addError("useremail", "The account doesn’t exists.");
		return false;
            }
            if (!Yii::$app->getSecurity()->validatePassword($this->userpass, $data->userpass))
            {
                $this->addError("userpass", "Email address or password incorrect, please check.");
            }
        }
    }
 
    public function validateEmail()
    {
	if(!$this->hasErrors()){
		$data = self::find()->where('useremail = :email',[':email' => $this->useremail])->one();
		if(is_null($data)){
                	$this->addError("useremail", "The account doesn’t exists.");
		}
	}	
    }

    
    public function reg($data, $scenario = 'reg')
    {
       $this->scenario = $scenario;
        if ($this->load($data) && $this->validate()) {
            $this->createtime = time();
            // $this->userpass = md5($this->userpass);
            $this->userpass = Yii::$app->getSecurity()->generatePasswordHash($this->userpass);
            if ($this->save(false)) {
                return true;
            }
            return false;
        }
        return false;
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['userid' => 'userid']);
    }

    public function getUser()
    {
        return self::find()->joinWith('profile')->where('useremail = :useremail', [':useremail' => $this->useremail])->one();
    }

    public function login($data)
    {
        $this->scenario = "login";
        if ($this->load($data) && $this->validate()) {
           	 return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 24*3600 : 0);
             }
        return false;
    }

    public function regByMail($data)
    {
        $this->scenario = 'regbymail';
        if ($this->load($data) && $this->validate()) {
            $mailer = Yii::$app->mailer->compose('createuser', ['userpass' => $data['User']['userpass'], 'useremail' => $data['User']['useremail']]);
            //$mailer->setFrom('info@qedertek.com');
            //$mailer->setTo($data['User']['useremail']);
            //$mailer->setSubject('Welcome '.$data['User']['useremail']);
            //if ($mailer->send() && $this->reg($data, 'regbymail')) {
            //if ($mailer->send() && $this->reg($data, 'regbymail')) {
            if (true && $this->reg($data, 'regbymail')) {
                return true;
            }
        }
        return false;
    }

    public function seekPass($data)
    {
        $this->scenario = "seekpass";
        if ($this->load($data) && $this->validate()) {
            //做点有意义的事
            $time = time();
            $token = $this->createToken($data['User']['useremail'], $time);
            $mailer = Yii::$app->mailer->compose('seekpass', ['useremail' => $data['User']['useremail'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("info@qedertek.com");
            $mailer->setTo($data['User']['useremail']);
            $mailer->setSubject("Reset your password");
            if ($mailer->send()) {
                return true;
            }
        }
        return false;
    
    }

    public function createToken($user, $time)
    {
        //return md5(md5($user).base64_encode(Yii::$app->request->userIP).md5($time));
	 return md5(md5($user.$time).md5($time));
    }
 
     public function changePass($data,$scenario = "changepass") 
    {
        $this->scenario = $scenario;
        if ($this->load($data) && $this->validate()) {
            if(!Yii::$app->user->isGuest){
		    $data = self::find()->where('userid = :id', [':id' => Yii::$app->user->id])->one();
		    if (!Yii::$app->getSecurity()->validatePassword($this->userpass, $data->userpass))
		    {
			$this->addError("oldpass", "password is wrong, please check.");
		    }
		    $this->userpass = Yii::$app->getSecurity()->generatePasswordHash($this->userpass);
            	    return (bool)$this->updateAll(['userpass' => $this->userpass], 'userid = :id', [':id' => Yii::$app->user->id]);
		
	    }else{
		    $data = self::find()->where('useremail = :useremail', [':useremail' => $data['User']['useremail']])->one();
		    if (is_null($data))
		    {
			$this->addError("useremail", "Email is wrong, please check.");
		    }
            	    $this->userpass = Yii::$app->getSecurity()->generatePasswordHash($this->userpass);
           	    return (bool)$this->updateAll(['userpass' => $this->userpass], 'useremail = :useremail', [':useremail' => $data['User']['useremail']]);
	    }
        }
        return false;
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    public function getId()
    {
        return $this->userid;
    }

    public function getAuthKey()
    {
        return '';
    }

    public function validateAuthKey($authKey)
    {
        return true;
    }
    

}

			
