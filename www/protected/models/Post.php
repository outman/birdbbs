<?php

/**
 * This is the model class for table "{{post}}".
 *
 * The followings are the available columns in table '{{post}}':
 * @property string $id
 * @property string $userId
 * @property string $title
 * @property string $nodeId
 * @property string $content
 * @property integer $status
 * @property string $reply
 * @property string $sort
 * @property string $hits
 * @property string $lastUpdateUserId
 * @property string $createTime
 * @property string $updateTime
 */
class Post extends Model
{
    const STATUS_NORMAL = 1;
    const STATUS_FROZEN = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{post}}';
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
            array('title, nodeId, content', 'required', 'on' => 'post'),
            array('title', 'length', 'max'=>256, 'on' => 'post'),
            array('title, nodeId, content', 'required', 'on' => 'post'),
            array('nodeId', 'numerical', 'integerOnly' => true, 'on' => 'post'),
            array('nodeId', 'length', 'max' => 10),
            array('id, userId, nodeId', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'node' => array(self::BELONGS_TO, 'Node', "nodeId"),
            'user' => array(self::BELONGS_TO, 'User', 'userId'),
            'by' => array(self::BELONGS_TO, 'User', 'lastUpdateUserId'),
            'comments' => array(self::HAS_MANY, 'Comment', "postId"),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => '#',
            'userId' => '用户',
            'title' => '标题',
            'nodeId' => '节点',
            'content' => '内容',
            'status' => '状态',
            'reply' => '回复数',
            'sort' => '排序',
            'hits' => '浏览',
            'lastUpdateUserId' => '最后更新人',
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
        $criteria->select = "id, title, userId, nodeId, reply, sort, hits, lastUpdateUserId, updateTime, createTime, status";
        $criteria->compare('id',$this->id);
        $criteria->compare('userId',$this->userId);
        $criteria->compare('nodeId',$this->nodeId);
        $criteria->compare('status', $this->status);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
            'sort' => array('defaultOrder' => 'sort desc, id desc'),
            'pagination' => array('pageSize' => 20,)
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Post the static model class
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
        $sql = "select FROM_UNIXTIME(createTime, '%Y-%m-%d %H:00:00') as hours, count(id)  as count from {{post}} where createTime > :start group by hours order by hours";
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
