<?php

/**
 * This is the model class for table "{{platform}}".
 *
 * The followings are the available columns in table '{{platform}}':
 * @property string $id
 * @property string $platform
 * @property string $uniqid
 * @property integer $userId
 * @property string $createTime
 * @property integer $updateTime
 */
class Platform extends Model
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{platform}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('platform, uniqid, userId', 'required'),
            array('userId, updateTime', 'numerical', 'integerOnly'=>true),
            array('platform', 'length', 'max'=>16),
            array('uniqid', 'length', 'max'=>32),
            array('createTime', 'length', 'max'=>10),
            array('id, platform, uniqid, userId, createTime, updateTime', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'platform' => '平台',
            'uniqid' => '平台唯一标识',
            'userId' => '绑定用户ID',
            'createTime' => '创建日期',
            'updateTime' => '修改日期',
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
		$criteria->compare('platform',$this->platform,true);
		$criteria->compare('uniqid',$this->uniqid,true);
		$criteria->compare('userId',$this->userId);
		$criteria->compare('createTime',$this->createTime,true);
		$criteria->compare('updateTime',$this->updateTime);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Platform the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
