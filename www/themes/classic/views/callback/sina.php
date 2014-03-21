<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>帐号绑定后可以直接采用微博登录</h4>
            </div>
            <div class="panel-body">
                <?php $form = $this->beginWidget("CActiveForm", array(
                    'id' => 'login-form',
                    'htmlOptions' => array(
                        'role'=>'form',
                    )
                )); ?>
               
                <div class="form-group">
                    <?php echo $form->textField($user, 'username', array("class"=>'form-control', 'placeholder'=>'用户名')) ?>
                    <?php echo $form->error($user, 'username', array('class' => 'help-block')) ?>
                </div>
                
                <div class="form-group">
                    <input type="submit" value="绑定" class="btn btn-primary">
                </div>
                <?php $this->endWidget(); ?>
            </div>
            <div class="panel-footer">
                <a href="<?php echo $this->createUrl("home/index") ?>">> 返回首页</a>
            </div>
        </div>
    </div>
</div>