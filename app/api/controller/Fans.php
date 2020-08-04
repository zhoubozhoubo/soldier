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
use think\exception\HttpResponseException;
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
        $token = '';

        $from = $this->request->get('from');
        $this->url = $this->request->url(true);

        $result = WechatService::instance()->getWebOauthInfo($this->url, 1,false);

        if (isset($result['oauthurl'])) {
            $result = [
                'code' => 1,
                'data' => $result['oauthurl'],
                'msg' => '跳转授权页'
            ];

            return json($result);
        }

        if(isset($result['source'])){
            $this->fans = $result['fansinfo'];

            $openid = $this->fans['openid'];
            $token = $this->fans['openid'];
//            $token = token($openid);
//            session($token, json_encode($this->fans));
        }
//        return $from . '?token=' . $token;
        throw new HttpResponseException(redirect($from . '?token=' . $token, 301));
    }

    public function loginOauth()
    {
        $from = $this->request->get('from');
//        $from = 'http://soldier.ninelie.site/#/policy/index';

        $result = WechatService::instance()->getWebOauthInfo($from, 1,false);

        return $this->success('跳转授权页成功',$result);
    }

    public function loginCode()
    {
        $from = $this->request->get('from');

        $result = WechatService::instance()->getWebOauthInfo($from, 1,false);

        $this->fans = $result['fansinfo'];
        $result['token'] = $this->fans['openid'];

        return $this->success('通过code换取成功',$result);
    }

    public function loginToken()
    {
        if (isset($_SERVER['HTTP_TOKEN']) && !empty($_SERVER['HTTP_TOKEN'])) {
            $this->token = $_SERVER['HTTP_TOKEN'];
        }

        if (isset($this->token) && !empty($this->token)) {
//            $this->fans = json_decode(session($this->token), true);
            $this->fans = $this->app->db->name('WechatFans')->where(['openid' => $this->token])->find();
            $this->currentFansId = $this->fans['id'];
        }

        if (!$this->fans) {
            return $this->error('token验证失败', '', 0);
        }

        return $this->success('token验证通过');
    }

}
