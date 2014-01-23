<?php

/**
 * This is the model class for table "{{forget}}".
 *
 * The followings are the available columns in table '{{forget}}':
 * @property string $id
 * @property string $email
 * @property string $token
 * @property string $expire
 * @property integer $status
 * @property string $createTime
 */
class Forget extends Model
{
    const STATUS_NORMAL = 1;
    const STATUS_FROZEN = 2;
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{forget}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('email', 'required', 'on' => 'post'),
            array('email', 'email', 'on' => 'post'),

            // array('email, token, expire', 'required'),
            // array('status', 'numerical', 'integerOnly'=>true),
            // array('email', 'length', 'max'=>128),
            // array('token', 'length', 'max'=>64),
            // array('expire, createTime', 'length', 'max'=>10),
            // array('id, email, token, expire', 'safe', 'on'=>'search'),
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
            'id' => 'ID',
            'email' => '邮箱',
            'token' => 'Token',
            'expire' => '过期时间',
            'status' => '状态',
            'createTime' => '创建日期',
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
        $criteria->compare('token',$this->token);
        $criteria->compare('expire',$this->expire);
        $criteria->compare('status',$this->status);
        $criteria->compare('createTime',$this->createTime);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Forget the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
