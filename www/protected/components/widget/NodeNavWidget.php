<?php 

class NodeNavWidget extends CWidget {

    public function run()
    {   
        $criteria = new CDbCriteria;
        $criteria->compare("status", Node::STATUS_NORMAL);

        $node = Node::model()->findAll($criteria);
        $this->render("nodenav", array("node" => $node));
    }
}