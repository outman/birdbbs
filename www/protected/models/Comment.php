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
class Comment extends Model
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
        return array(
            array('postId, content', 'required', 'on' => 'post'),
            array('postId', 'numerical', 'integerOnly' => true, 'on' => 'post'),
            array('postId', 'length', 'max' => 10, 'on' => 'post'),
            array('id, postId, userId', 'safe', 'on'=>'search'),
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
        $criteria=new CDbCriteria;

        $criteria->compare('id',$this->id);
        $criteria->compare('postId',$this->postId);
        $criteria->compare('userId',$this->userId);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array('defaultOrder' => 'id desc'),
            'pagination' => array(
                'pageSize' => 20,
            )
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

    /**
     * [chart description]
     * @return [type] [description]
     */
    public function chart()
    {
        $startTime = strtotime("-1 day");
        $sql = "select FROM_UNIXTIME(createTime, '%Y-%m-%d %H:00:00') as hours, count(id)  as count from {{comment}} where createTime > :start group by hours order by hours";
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
