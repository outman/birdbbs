<?php

/**
 * This is the model class for table "{{config}}".
 *
 * The followings are the available columns in table '{{config}}':
 * @property string $key
 * @property string $value
 */
class Config extends Model
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{config}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('key', 'unique'),
            array('key, value', 'required'),
            array('key', 'length', 'max'=>64),
            array('key, value', 'safe', 'on'=>'search'),
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
            'key' => '配置参数',
            'value' => '内容',
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

        $criteria->compare('key',$this->key);
        $criteria->compare('value',$this->value);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Config the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function metas()
    {
        return array(
            'site_title' => '网页标题',
            'site_url' => '网站域名',
            'site_keywords' => '网站关键字',
            'site_description' => '网站SEO描述',
            'site_beian' => '网站备案号',
        );
    }
}
