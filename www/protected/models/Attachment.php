<?php

/**
 * This is the model class for table "{{attachment}}".
 *
 * The followings are the available columns in table '{{attachment}}':
 * @property string $id
 * @property string $path
 * @property string $url
 * @property string $name
 * @property string $mime
 * @property string $size
 * @property string $table
 * @property string $parentId
 * @property string $createTime
 */
class Attachment extends Model
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{attachment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('path, url, name, mime, size', 'required'),
            array('path, url, name', 'length', 'max'=>256),
            array('mime', 'length', 'max'=>128),
            array('size, parentId, createTime', 'length', 'max'=>10),
            array('table', 'length', 'max'=>64),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, path, url, name, mime, size, table, parentId, createTime', 'safe', 'on'=>'search'),
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
            'path' => '路径',
            'url' => 'URL',
            'name' => '名称',
            'mime' => 'MIME',
            'size' => '大小',
            'table' => '数据表',
            'parentId' => '主键',
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('name',$this->name);
        $criteria->compare('mime',$this->mime);
        $criteria->order = "id desc";

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Attachment the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
