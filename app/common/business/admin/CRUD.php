<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2021/1/11 9:20
 */


namespace app\common\business\admin;

use think\facade\Db;

class CRUD
{

    private $table = null;

    public function __construct($table){
        $this -> table = $table;
    }

    public function findById($id){
        return Db::table($this -> table) -> where('id', $id) -> find();
    }

    public function create($data){
        Db::table($this -> table) -> strict(false) -> insert($data);
    }

    public function delete($id){
        Db::table($this -> table) -> delete($id);
    }

    public function update($update){
        Db::table($this -> table) -> save($update);
    }

    public function retrieve($field, $name){
        return Db::table($this -> table) -> whereLike($field, '%' . $name . '%') -> select();
    }

    public function show($num){
        return Db::name($this -> table) -> where('id', '>', 0) -> order('id', 'desc') -> paginate($num);
    }

    public function createAll($data){
        Db::name($this -> table) -> insertAll($data);
    }

}