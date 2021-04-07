<?php
use think\facade\Env;

// +----------------------------------------------------------------------
// | 缓存设置
// +----------------------------------------------------------------------

return [
    // 默认缓存驱动
    'default' => Env::get('cache.driver', 'redis'),

    // 缓存连接方式配置
    'stores'  => [
        'redis' => [
            'host'       => '127.0.0.1',
            'port'       => 6379,
            'type'       => 'redis',
            'select'     => 0
        ],
    ],
];
