<?php
/**
 *
 * @description: 人生五十年，与天地长久相较，如梦又似幻
 *
 * @author: Shane
 *
 * @time: 2020/9/30 15:13
 */


namespace app\common\model\admin;


use think\Model;

/**后台权限规则模型
 * Class AuthAccess
 * @package app\common\model\admin
 */

class AuthRule extends Model
{

    protected $table = 'z_admin_auth_rule';

    public function ruleComment(){
        $menus = $this -> where('is_menu', 1) -> where('status', 1) -> order('weigh') -> select();
        $result = [];
        foreach ($menus as $menu){
            $views = $this -> where('pid', $menu['id']) -> where('is_view', 1) -> where('status', 1) -> order('weigh') -> select();
            $viewRes = [];
            foreach ($views as $view){
                $apis = $this -> where('pid', $view['id']) -> where('is_menu', 0) -> where('is_view', 0) -> where('status', 1) -> order('weigh') -> select();
                $apisRes = [];
                foreach ($apis as $api){
                    $apisRes[] = [
                        'id' => $api['id'],
                        'label' => $api['name'],
                    ];
                }
                $viewRes[] = [
                    'id' => $view['id'],
                    'label' => $view['name'],
                    'children' => $apisRes
                ];
            }
            $result[] = [
                'id' => $menu['id'],
                'label' => $menu['name'],
                'children' => $viewRes
            ];
        }
        $views = $this -> where('pid', NULL) -> where('is_view', 1)  -> where('status', 1) -> order('weigh') -> select();
        foreach ($views as $view){
            $apis = $this -> where('pid', $view['id']) -> where('is_menu', 0) -> where('is_view', 0) -> where('status', 1) -> order('weigh') -> select();
            $apisRes = [];
            foreach ($apis as $api){
                $apisRes[] = [
                    'id' => $api['id'],
                    'label' => $api['name'],
                ];
            }
            $result[] = [
                'id' => $view['id'],
                'label' => $view['name'],
                'children' => $apisRes
            ];
        }
        return $result;
    }

    public function otherAdminMenuAndView($rules){
        $menus = $this -> where('is_menu', 1) -> where('status', 1) -> order('weigh') -> select();
        $result = [];
        foreach ($menus as $menu){
            if (in_array($menu['id'], $rules)){
                $views = $this -> where('pid', $menu['id']) -> where('is_view', 1) -> where('status', 1) -> order('weigh') -> select();
                $temp = [];
                foreach ($views as $view){
                    if (in_array($view['id'], $rules)){
                        $temp[] = $view;
                    }
                }
                $result[] = [
                    'menu' => $menu,
                    'view' => $temp
                ];
            }
        }
        $data = $this -> where('pid', NULL) -> where('is_view', 1) -> where('status', 1) -> order('weigh') -> select();
        $view = [];
        foreach ($data as $key){
            if (in_array($key['id'], $rules)){
                $view[] = $key;
            }
        }
        return [
            'view' => $view,
            'viewWithMenu' => $result
        ];
    }

    public function superAdminMenuAndView(){
        $menus = $this -> where('is_menu', 1) -> order('weigh') -> select();
        $result = [];
        foreach ($menus as $menu){
            $views = $this -> where('pid', $menu['id']) -> where('is_view', 1) -> order('weigh') -> select();
            $result[] = [
                'menu' => $menu,
                'view' => $views
            ];
        }
        $view = $this -> where('pid', NULL) -> where('is_view', 1) -> order('weigh') -> select();
        return [
            'view' => $view,
            'viewWithMenu' => $result
        ];
    }

    public function findMenuAndView($num){
        return $this -> where('id', '>', 0)
            -> where('is_menu', 1)
            -> whereOr('is_view', 1)
            -> field(['id', 'name', 'icon', 'pid', 'weigh', 'status'])
            -> paginate($num);
    }

    public function updateById($data){
        $result = $this -> findById($data['id']);
        return $result -> allowField(['name', 'icon', 'weigh', 'status']) -> save($data);
    }

    public function findById($id){
        return $this -> where('id', $id) -> find();
    }

    public function findByIdWithStatus($id){
        return $this -> where('id', $id) -> where('status', 1) -> find();
    }

}