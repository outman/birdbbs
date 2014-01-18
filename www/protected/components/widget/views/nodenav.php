<li class="dropdown">
     <a href="#" class="dropdown-toggle" data-toggle="dropdown">节点 <b class="caret"></b></a>
     <ul class="dropdown-menu">
          <li><a href="<?php echo Yii::app()->createUrl("home/index") ?>">全部</a></li>
          <?php if ($node) foreach ($node as $v): ?>
          <li><a href="<?php echo Yii::app()->createUrl("home/index", array("Post[nodeId]" => $v->id)) ?>"><?php echo CHtml::encode($v->name); ?></a></li>
          <?php endforeach; ?>
     </ul>
 </li>