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
 * 活动资源接口
 * Class ActivityResource
 * @package app\api\controller
 */
class ActivityResource extends BaseApi
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessActivityResource';

    /**
     * 所有数据
     */
    public function getAll()
    {
        print_r(session());

        $activity_type_id = $this->request->get('activity_type_id');
        $resource_type = $this->request->get('resource_type');
        $where['activity_type_id'] = $activity_type_id;
        $where['resource_type'] = $resource_type;

        $data = $this->BaseAll($this->table, $where, 'sort asc, create_at desc');

        return $this->returnSuccess($data);
    }

    /**
     * 分页数据
     */
    public function getPage()
    {
        $activity_type_id = $this->request->get('activity_type_id');
        $resource_type = $this->request->get('resource_type');
        $where['activity_type_id'] = $activity_type_id;
        $where['resource_type'] = $resource_type;

        $data = $this->BasePage($this->table, $where, 'sort asc, create_at desc');

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
