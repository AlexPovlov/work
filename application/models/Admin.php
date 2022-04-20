<?php
namespace application\models;
use application\core\Model;

/**
 * модель
 */

class Admin extends Model 
{
    /**
     * берет массив данных с базы
     * return array table data
     */

    public function getCategory()
    {
        return $this->db->GetAllSqlRequest("SELECT * FROM `data` ORDER BY `data`.`parent_id` ASC",[]);
    }

    public function getCategoryFromId($id)
    {
        return $this->db->GetOneSqlRequest("SELECT * FROM `data` WHERE `id`=:id",['id'=>$id]);
    }

    /**
     * создает массив дерево
     * @param array $items изначальный массив
     * @param int $parent id родителя
     * @return array $tree готовый массив дерево
     */

    function buildTree(array $items, $parent = 0)
    {
        $tree = [];
        foreach ($items as $item){
            if($item['parent_id'] == $parent){
                $children = $this->buildTree($items, $item['id']);
                if($children){
                    $item['children'] = $children;
                }
                $tree[] = $item;
            }
        }
        return $tree;
    }

    public function recursdelete($id)
    {
        $this->db->SendSqlRequest("DELETE FROM `data` WHERE `data`.`id` = :id",['id'=>$id]);
        $children = $this->db->GetAllSqlRequest("SELECT * FROM `data` WHERE parent_id=:id",['id'=>$id]);
        if ($children != NULL) {
            foreach ($children as $key => $value) {
                $this->recursdelete($value['id']);
            }
        }
    }

    public function addData($parent_id,$catgory_name,$description)
    {
        $this->db->SendSqlRequest("INSERT INTO `data`(`parent_id`, `name`, `description`) 
            VALUES (:parent_id,:name,:description)",
            ['parent_id'=>$parent_id,
            'name'=>$catgory_name,
            'description'=>$description,]);
    }

    public function updateData($id,$parent_id,$catgory_name,$description)
    {
        $this->db->SendSqlRequest("UPDATE `data` 
        SET `parent_id`=:parent_id,`name`=:name,`description`=:description 
        WHERE `id`=:id",
            ['id'=>$id,
            'parent_id'=>$parent_id,
            'name'=>$catgory_name,
            'description'=>$description,]);
    }


}
