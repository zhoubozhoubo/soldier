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

/**
 * 关于信息接口
 * Class About
 * @package app\api\controller
 */
class About extends BaseApi
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'SystemConfig';

    /**
     * 所有数据
     */
    public function getDetail()
    {
        $where = [
            'type' => 'base',
            'name' => 'about'
        ];
        $about = $this->app->db->name($this->table)->where($where)->find();

        return $this->returnSuccess($about);
    }

}
