<div>
<form action="/admin/update/<?php echo $data['id'] ?>" method="post">
    <select  name="parent" class="" required="">
    <?php if($data['parent_id'] == 0): ?>
        <option value="0" >корень</option>
        <?php foreach ($params as $param): ?>
            <?php if($data['id'] != $param['id'] and $data['parent_id'] != $param['id']): ?>
                <option value="<?php echo $param['id'] ?>"><?php echo $param['name'] ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php elseif($data['parent_id'] > 0): ?>
        <option value="<?php echo $data['parent_id'] ?>" ><?php echo $parent['name'] ?></option>
        <option value="0" >корень</option>
        <?php foreach ($params as $param): ?>
            <?php if($data['id'] != $param['id'] and $data['parent_id'] != $param['id']): ?>	
                <option value="<?php echo $param['id'] ?>"><?php echo $param['name'] ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
            	
    </select>
    <input type="text" name="category" value="<?php echo $data['name'] ?>">
    <input type="text" name="description" value="<?php echo $data['description'] ?>">
    <input type="submit" value="добавить">
</form>

</div>