<div class="">
<form action="/admin" method="post">
    <select  name="parent" class="" required="">
        <option value="0" >корень</option>
            <?php foreach ($params as $param): ?>	
                <option value="<?php echo $param['id'] ?>"><?php echo $param['name'] ?></option>
            <?php endforeach; ?>	
    </select>
    <input type="text" name="category" >
    <input type="text" name="description" >
    <input type="submit" value="добавить">
</form>
</div>