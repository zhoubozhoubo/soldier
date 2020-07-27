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

namespace app\api\service;

use app\api\controller\Fans;
use app\wechat\service\WechatService;
use think\admin\Service;

/**
 * 微信粉丝
 * Class FansService
 * @package app\wechat\service
 */
class FansService extends Service
{

    /**
     * 粉丝登录
     */
    public function login()
    {
        WechatService::instance()->getWebOauthInfo('http://soldier.ninelie.site/#/consult/index');

        /*$openid = '123456';
        $fans = $this->app->db->name('WechatFans')->where(['openid' => $openid])->find();

        $token = token($openid);
        session($token, json_encode($fans));

        return $token;*/
    }

}
