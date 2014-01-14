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
    const STATUS_NORMAL = 1;
    const STATUS_FROZEN = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{user}}';
    }

    public function statusList() {
        return array(
            self::STATUS_NORMAL => '正常',
            self::STATUS_FROZEN => '冻结',
        );
    }

    public function displayStatus($status = null) {

        if (null === $status) {
            $status = $this->status;
        }
        $list = $this->statusList();
        
        if (isset($list[$status])) {
            return $list[$status];
        }

        return $status;
    }


    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
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
            array('id, username, email', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '#',
            'username' => '用户名',
            'password' => '密码',
            'email' => '邮箱',
            'siteUrl' => '个人站点',
            'qq' => 'QQ',
            'location' => '所在地',
            'flag' => '签名',
            'intro' => '简介',
            'status' => '状态',
            'avatar' => '头像',
            'createTime' => '创建日期',
            'lastIp' => '登录IP',
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
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('username',$this->username);
        $criteria->compare('email',$this->email);
        $criteria->order = "id desc";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
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

    public function beforeSave()
    {
        if ($this->getIsNewRecord()) {
            $this->createTime = time();
            $this->status = self::STATUS_NORMAL;
        }

        return parent::beforeSave();
    }
}
