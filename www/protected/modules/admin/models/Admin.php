<?php

/**
 * This is the model class for table "{{admin}}".
 *
 * The followings are the available columns in table '{{admin}}':
 * @property string $id
 * @property string $email
 * @property string $password
 * @property integer $status
 * @property string $loginIp
 * @property string $createTime
 * @property string $updateTime
 */
class Admin extends Model
{
    const STATUS_NORMAL = 1;
    const STATUS_FROZEN = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{admin}}';
    }

    /**
     * [statusList description]
     * @return [type] [description]
     */
    public function statusList()
    {
        return array(
            self::STATUS_NORMAL => '正常',
            self::STATUS_FROZEN => '冻结',
        );
    }

    /**
     * [displayStatus description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    public function displayStatus($status = null)
    {
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
            array('email, password', 'required'),
            array('email', 'email'),
            array('email', 'unique'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('email, password', 'length', 'max'=>128),
            array('loginIp', 'length', 'max'=>64),
            array('createTime, updateTime', 'length', 'max'=>10),
            array('id, email, password, status, loginIp, createTime, updateTime', 'safe', 'on'=>'search'),
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
            'email' => '邮箱',
            'password' => '密码',
            'status' => '状态',
            'loginIp' => 'IP',
            'createTime' => '创建日期',
            'updateTime' => '更新日期',
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
        $criteria->compare('email',$this->email);
        $criteria->order = "id desc";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Admin the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
