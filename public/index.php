<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2020 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: https://thinkadmin.top
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee 代码仓库：https://gitee.com/zoujingli/ThinkAdmin
// | github 代码仓库：https://github.com/zoujingli/ThinkAdmin
// +----------------------------------------------------------------------

namespace think;

use think\admin\service\SystemService;

    // 允许的源原域名
    header('Access-Control-Allow-Origin: *');

    //  允许的请求头信息
    header("Access-Control-Allow-Headers:Origin, X-requested-width, Content-type, Accept, token");

    // 允许的请求类型
    header("Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS, PATCH");

require __DIR__ . '/../vendor/autoload.php';

SystemService::instance()->doInit(new App());