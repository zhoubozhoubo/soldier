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

use think\admin\Controller;
use think\App;

/**
 * 粉丝信息接口
 * Class FansInfo
 * @package app\api\controller
 */
class FansInfo extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'WechatFansInfo';

    public $token;

    public $fans;
    public $currentFansId;

    public function __construct(App $app)
    {
        $this->app = $app;
        if (isset($_SERVER['HTTP_TOKEN']) && !empty($_SERVER['HTTP_TOKEN'])) {
            $this->token = $_SERVER['HTTP_TOKEN'];
        }

        if (isset($this->token) && !empty($this->token)) {
            $this->fans = json_decode(session($this->token), true);
            $this->currentFansId = $this->fans['id'];
        }

        if (!$this->fans) {
            return $this->error('未登录，请先登录');
        }

        parent::__construct($app);
    }

    /**
     * 粉丝实名
     */
    public function realname()
    {
        if ($this->request->isPost()) {
            $wechat_fans_id = $this->currentFansId;

            if ($this->app->db->name($this->table)->where(['wechat_fans_id'=>$wechat_fans_id])->count() > 0) {
                return $this->error('当前登录用户已实名');
            }

            $data = $this->request->post();
            $data['wechat_fans_id'] = $wechat_fans_id;

            // 手机号判重
            if ($this->app->db->name($this->table)->where(['phone'=>$data['phone']])->count() > 0) {
                return $this->error('该手机号已被认证，请重新输入');
            }
            // 身份证号判重
            if ($this->app->db->name($this->table)->where(['id_number'=>$data['id_number']])->count() > 0) {
                return $this->error('该身份证号已被认证，请重新输入');
            }

            $fansInfo = $this->app->db->name($this->table)->save($data);
            if (!$fansInfo) {
                return $this->error('认证失败，请稍后重试');
            } else {
                // 更新fans实名认证
                $fans = [
                    'id' => $wechat_fans_id,
                    'is_realname' => 1
                ];
                $this->app->db->name('WechatFans')->update($fans);
                $fans = $this->app->db->name('WechatFans')->find($wechat_fans_id);

                //更新session
                session($this->token, json_encode($fans));

                return $this->success($fans, '认证成功');
            }
        } else {
            return $this->error('请求错误');
        }
    }

}
