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
use app\wechat\service\WechatService;
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
        $log = new Log($this->app);
        /*
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

        FansService::instance()->login('http://soldier.ninelie.site/#/consult/index
');*/

        $from = $this->request->get('from');
//        $from = $this->request->url(true);
//        $log->write('this->url:' . $this->url, 'alert');
        $result = WechatService::instance()->getWebOauthInfo($from, 1,false);
        if (isset($result['oauthurl'])) {
            $result = [
                'code' => 1,
                'data' => $result['oauthurl'],
                'msg' => '跳转授权页'
            ];

            return json($result);
        }
//        $this->fans = WechatService::instance()->getWebOauthInfo('http://soldier.ninelie.site/consult/index', 1);

//        $this->fans = WechatService::instance()->getWebOauthInfo($this->url);
//        print_r(123);

        /* $openid = $this->fans['openid'];

         if ($this->app->db->name('WechatFans')->where(['openid' => $openid])->count() === 0) {
             $this->app->db->name('WechatFans')->save(['openid'=>$openid]);
         }

         $fans = $this->app->db->name('WechatFans')->where(['openid' => $openid])->find();

         $token = token($openid);
         session($token, json_encode($fans));

         return $token;*/
    }

    public function getCode()
    {
        WechatService::instance()->getWebOauthInfo('http://www..ninelie.site/api/Fans/getOauthInfo');
    }

    public function getOauthInfo()
    {
        WechatService::instance()->getWebOauthInfo('');
    }

}
