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

/**
 * 援助点位接口
 * Class HelpSpot
 * @package app\api\controller
 */
class HelpSpot extends BaseApi
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessHelpSpot';

    /**
     * 所有数据
     */
    public function getAll()
    {
        $spot_type = $this->request->get('spot_type');
        $where['spot_type'] = $spot_type;

        $data = $this->BaseAll($this->table, $where);

        return $this->returnSuccess($data);
    }

    /**
     * 分页数据
     */
    public function getPage()
    {
        $spot_type = $this->request->get('spot_type');
        $where['spot_type'] = $spot_type;

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
