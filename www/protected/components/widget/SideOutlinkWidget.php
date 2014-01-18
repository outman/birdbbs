<?php 

class SideOutlinkWidget extends CWidget {


    public function run()
    {
        $criteria = new CDbCriteria;
        $criteria->order = "sort desc";

        $link = Outlink::model()->findAll($criteria);
        $this->render("sideoutlink", array("link" => $link));
    }
}