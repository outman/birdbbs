<?php
/**
 * This is the template for generating a controller class file.
 * The following variables are available in this template:
 * - $this: the ControllerCode object
 */
?>
<?php echo "<?php\n"; ?>

class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{
<?php foreach($this->getActionIDs() as $action): ?>
    public function action<?php echo ucfirst($action); ?>()
    {
        $this->render('<?php echo $action; ?>');
    }

<?php endforeach; ?>
}