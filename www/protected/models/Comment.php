<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property string $id
 * @property string $postId
 * @property string $userId
 * @property string $content
 * @property string $createTime
 * @property string $updateTime
 */
class Comment extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{comment}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('postId, userId, content', 'required'),
            array('postId, userId, createTime, updateTime', 'length', 'max'=>10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, postId, userId, content, createTime, updateTime', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'post' => array(self::BELONGS_TO, 'Post', 'postId'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '#',
            'postId' => '帖子',
            'userId' => '用户',
            'content' => '内容',
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
        $criteria->compare('postId',$this->postId,true);
        $criteria->compare('userId',$this->userId,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Comment the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
