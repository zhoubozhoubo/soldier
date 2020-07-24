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
 * Banner信息接口
 * Class Banner
 * @package app\api\controller
 */
class Banner extends BaseApi
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessBanner';

    /**
     * 所有数据
     */
    public function getAll()
    {
        $banner_type = $this->request->get('banner_type');
        $where['banner_type'] = $banner_type;

        $data = $this->BaseAll($this->table, $where);

        return $this->returnSuccess($data);
    }

}
