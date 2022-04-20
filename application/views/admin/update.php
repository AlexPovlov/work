

<ul>
    <?php foreach($params as $param): ?>
        <li ><span id="<?php echo $param['id'] ?>"><?php echo $param['name'] ?>
                
            </span>
                <a href="/admin/delete/<?php echo $param['id'] ?>">удалить</a>
                <a href="/admin/update/<?php echo $param['id'] ?>">обновить</a>
            <?php if(!empty($param['children'])): ?>
                
                <?php echo application\core\View::statrender('admin/update', $vars = ['params'=>$param['children'], 'parent_id'=>$param['parent_id']]); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
