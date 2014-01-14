<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $siteUrl
 * @property string $qq
 * @property string $location
 * @property string $flag
 * @property string $intro
 * @property integer $status
 * @property string $avatar
 * @property string $createTime
 * @property string $lastIp
 */
class User extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username, password, email', 'required'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('username, location', 'length', 'max'=>32),
            array('password, email, flag', 'length', 'max'=>128),
            array('siteUrl, avatar', 'length', 'max'=>512),
            array('qq', 'length', 'max'=>20),
            array('intro', 'length', 'max'=>256),
            array('createTime', 'length', 'max'=>10),
            array('lastIp', 'length', 'max'=>64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, email, siteUrl, qq, location, flag, intro, status, avatar, createTime, lastIp', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'siteUrl' => 'Site Url',
            'qq' => 'Qq',
            'location' => 'Location',
            'flag' => 'Flag',
            'intro' => 'Intro',
            'status' => 'Status',
            'avatar' => 'Avatar',
            'createTime' => 'Create Time',
            'lastIp' => 'Last Ip',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('siteUrl',$this->siteUrl,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('flag',$this->flag,true);
		$criteria->compare('intro',$this->intro,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('avatar',$this->avatar,true);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('lastIp',$this->lastIp,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
