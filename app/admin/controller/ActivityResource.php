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

namespace app\admin\controller;

use app\admin\service\ActivityTypeService;
use think\admin\Controller;

/**
 * 活动资源管理
 * Class ActivityResource
 * @package app\admin\controller
 */
class ActivityResource extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessActivityResource';

    /**
     * 活动资源管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '活动资源管理';
        $query = $this->_query($this->table)->like('author');
        $query->equal('status');
        // 加载对应数据列表
        $this->type = input('type', 'all');
        if ($this->type === 'all') {
            $query->where(['is_deleted' => '0', 'status' => '1']);
        } elseif ($this->type = 'recycle') {
            $query->where(['is_deleted' => '0', 'status' => '0']);
        }
        // 列表排序并显示
        $query->order('id desc')->page();
    }

    /**
     * 列表数据处理
     * @param $data
     */
    protected function _index_page_filter(&$data)
    {
        foreach ($data as &$vo) {
            $vo['activity_type_title'] = ActivityTypeService::instance()->getTitleById($vo['activity_type_id']);
        }
    }

    /**
     * 添加活动资源
     * @auth true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add()
    {
        $this->_applyFormToken();
        $this->_form($this->table, 'form');
    }

    /**
     * 编辑活动资源
     * @auth true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit()
    {
        $this->_applyFormToken();
        $this->_form($this->table, 'form');
    }

    /**
     * 表单数据处理
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function _form_filter(&$data)
    {
        if ($this->request->isPost()) {
            if (!isset($data['activity_type_id']) || empty($data['activity_type_id'])) {
                $this->error('请选择活动系列！');
            }
        } else if ($this->request->isGet()) {
            $resource_type = $this->request->get('resource_type', 2);
            $this->resource_type = $resource_type;

            $activity_types = $this->app->db->name('BusinessActivityType')->where(['status' => '1'])->order('sort desc,id asc')->column('id,title', 'id');
            $this->activity_types = $activity_types;
        }
    }

    /**
     * 表单结果处理
     * @param boolean $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            $this->success('恭喜, 活动资源保存成功！');
        } else {
            $this->error('活动资源保存失败, 请稍候再试！');
        }
    }

    /**
     * 修改活动资源状态
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function state()
    {
        $this->_applyFormToken();
        $this->_save($this->table, ['status' => intval(input('status'))]);
    }

    /**
     * 删除活动资源
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function remove()
    {
        $this->_applyFormToken();
        $this->_delete($this->table);
    }

}
