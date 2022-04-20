
<ul class="sidebar">
    <?php foreach($params as $param): ?>
        <li ><span id="<?php echo $param['id'] ?>"><?php echo $param['name'] ?></span> 
            <?php if(!empty($param['children'])): ?>
                
                <?php echo application\core\View::statrender('main/index', $vars = ['params'=>$param['children'], 'parent_id'=>$param['parent_id']]); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>

