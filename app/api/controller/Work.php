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
 * 工作动态接口
 * Class Work
 * @package app\api\controller
 */
class Work extends BaseApi
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessWork';

    /**
     * 所有数据
     */
    public function getAll()
    {
        $data = $this->BaseAll($this->table, [], 'sort asc, time desc, create_at desc');

        return $this->returnSuccess($data);
    }

    /**
     * 分页数据
     */
    public function getPage()
    {
        $data = $this->BasePage($this->table, [], 'sort asc, time desc, create_at desc');

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
