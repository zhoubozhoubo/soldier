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
use think\Log;

/**
 * 咨询信息接口
 * Class Consult
 * @package app\api\controller
 */
class Consult extends BaseApi
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessConsult';

    /**
     * 所有数据
     */
    public function getAll()
    {
        $where['wechat_fans_id'] = $this->currentFansId;
        $data = $this->BaseAll($this->table, $where);

        return $this->returnSuccess($data);
    }

    /**
     * 分页数据
     */
    public function getPage()
    {
        $where['wechat_fans_id'] = $this->currentFansId;
        $data = $this->BasePage($this->table, $where);

        return $this->returnSuccess($data);
    }

    /**
     * 详情数据
     */
    public function getDetails()
    {
        $data = $this->BaseDetails($this->table);

        if ($data) {
            return $this->returnSuccess($data);
        } else {
            return $this->returnError('请求参数错误');
        }
    }

}
