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

namespace app\wechat\service;

use think\admin\Service;

/**
 * 微信粉丝实名信息
 * Class FansInfoService
 * @package app\wechat\service
 */
class FansInfoService extends Service
{

    /**
     * 获取粉丝实名信息
     * @param $id
     * @return mixed
     */
    public function getFansInfo($id)
    {
        return $this->app->db->name('WechatFansInfo')->where(['wechat_fans_id' => $id])->field('wechat_fans_id, name, phone, id_number')->find();
    }

}
