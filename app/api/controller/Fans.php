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

namespace app\api\controller;

use app\api\service\FansService;
use think\admin\Controller;
use think\Log;

/**
 * 微信粉丝接口
 * Class Fans
 * @package app\api\controller
 */
class Fans extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'WechatFans';

    /**
     * 粉丝登录
     */
    public function login()
    {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

        FansService::instance()->login($referer);
    }

}
