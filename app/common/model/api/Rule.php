<?php
/**
 *
 * @description: 永远爱颍
 *
 * @author: Shane
 *
 * @time: 2021/4/9 19:03
 */


namespace app\common\model\api;


use think\Model;

/**后台权限规则模型
 * Class AuthAccess
 * @package app\common\model\admin
 */

class Rule extends Model
{

    protected $name = 'api_rule';

    public function menuAndView(){
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

}