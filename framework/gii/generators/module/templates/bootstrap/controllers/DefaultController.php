<?php echo "<?php\n"; ?>

class DefaultController extends BackendController
{
    public function actionIndex()
    {
        $this->render('index');
    }
}