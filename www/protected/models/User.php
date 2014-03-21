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
class User extends Model
{
    const STATUS_NORMAL = 1;
    const STATUS_FROZEN = 2;

    const UNDEFINED_PWD = '_PWD';
    
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

            array('username, password, email', 'required', 'on' => 'register, insert'),
            array('email', 'email', 'on' => 'register, insert'),
            array('username, email', 'unique', 'on' => 'register, insert'),
            array('username, password', 'length', 'min' => 5, 'max' => 20, 'on' => 'register, insert'),
                
            array('qq', 'length', 'max' => 12, 'min' => 6, 'on' => 'update, insert'),
            array('qq', 'numerical', 'integerOnly' => true),
            array('location', 'length', 'max' => 32, 'min' => 2, 'on' => 'update, insert'),
            array('flag, intro', 'length', 'max' => 128, 'on' => 'update, insert'),
            array('siteUrl', 'length', 'max' => 512, 'on' => 'update, insert'),
            array('siteUrl', 'url', 'on' => 'update, insert'),

            array('password', 'required', 'on' => 'password'),
            array('password', 'length', 'min' => 5, 'max' => 20, 'on' => 'password'),

            array('status', 'in', 'range' => array(self::STATUS_NORMAL, self::STATUS_FROZEN), 'on' => 'update'),

            array('id, username, email', 'safe', 'on' => 'search'),
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
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array('defaultOrder' => 'id desc'),
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

    public function chart()
    {
        $startTime = strtotime("-30 day");
        $sql = "select FROM_UNIXTIME(createTime, '%Y-%m-%d') as hours, count(id)  as count from {{user}} where createTime > :start group by hours order by hours";
        $models = Yii::app()->db->cache(300)->createCommand($sql)->queryAll(true, array(
            ":start" => $startTime,
        ));

        $ret = array();
        if ($models) foreach ($models as $v) {
            $ret[] = array(
                'hour' => substr($v['hours'], -8),
                'count' => $v['count'],
            );
        }
        return $ret;
    }
}
