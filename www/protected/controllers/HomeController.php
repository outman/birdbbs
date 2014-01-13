<?php 

class HomeController extends FrontController
{
    public function actionIndex()
    {
        $this->render("index");
    }
}