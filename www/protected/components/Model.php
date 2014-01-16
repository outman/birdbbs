<?php 

class Model extends CActiveRecord {

    public function beforeSave()
    {
        if ($this->getIsNewRecord()) {
            if (isset($this->createTime)) {
                $this->createTime = time();
            }
        }
        elseif (isset($this->updateTime)) {
            $this->updateTime = time();
        }

        return parent::beforeSave();
    }
}