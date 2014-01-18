<?php

/**
 * This is the model class for table "{{outlink}}".
 *
 * The followings are the available columns in table '{{outlink}}':
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property string $sort
 * @property string $createTime
 */
class Outlink extends Model
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{outlink}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, url', 'required'),
            array('name', 'length', 'max'=>64),
            array('url', 'length', 'max'=>512),
            array('description', 'length', 'max'=>256),
            array('sort, createTime', 'length', 'max'=>10),
            array('id, name, url, description, sort, createTime', 'safe', 'on'=>'search'),
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
            'id' => '#',
            'name' => '站点名称',
            'url' => '链接',
            'description' => '描述',
            'sort' => '排序',
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
        $criteria->compare("id", $this->id);
        $criteria->compare("name", $this->name);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array('defaultOrder'=>'sort desc'),
            'pagination' => array('pageSize' => 15)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Outlink the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
