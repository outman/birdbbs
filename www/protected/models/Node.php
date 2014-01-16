<?php

/**
 * This is the model class for table "{{node}}".
 *
 * The followings are the available columns in table '{{node}}':
 * @property string $id
 * @property string $name
 * @property integer $status
 * @property string $sort
 * @property string $createTime
 * @property string $description
 */
class Node extends Model
{
    const STATUS_NORMAL = 1;
    const STATUS_CLOSE = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{node}}';
    }

    /**
     * [statusList description]
     * @return [type] [description]
     */
    public function statusList()
    {
        return array(
            self::STATUS_NORMAL => '正常',
            self::STATUS_CLOSE => '关闭',
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
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('status', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max'=>64),
            array('sort, createTime', 'length', 'max'=>10),
            array('description', 'length', 'max'=>256),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, status, sort, createTime, description', 'safe', 'on'=>'search'),
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
            'name' => '名称',
            'status' => '状态',
            'sort' => '排序',
            'createTime' => '创建日期',
            'description' => '描述',
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('status',$this->status);
        $criteria->compare('sort',$this->sort,true);
        $criteria->compare('createTime',$this->createTime,true);
        $criteria->compare('description',$this->description,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Node the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
