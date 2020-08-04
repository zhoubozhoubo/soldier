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

    public function loginToken()
    {
        $openid = $this->request->get('openid');
        $this->fans = $this->app->db->name('WechatFans')->where(['openid' => $openid])->find();

        $token = token($openid);

        session($token, json_encode($this->fans));

        $data = [
            'token' => $token,
            'fans' => session($token)
        ];
        return $this->success('获取token成功', $data);
    }

    public function loginTest()
    {
        $from = $this->request->get('from');

        $this->fans = $this->app->db->name($this->table)->where(['openid' => '123'])->find();

        $openid = $this->fans['openid'];
        $token = token($openid);
        session($token, json_encode($this->fans));

        return $token;
    }

}
