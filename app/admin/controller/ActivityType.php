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

use think\admin\Controller;

/**
 * 活动类型管理
 * Class ActivityType
 * @package app\admin\controller
 */
class ActivityType extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessActivityType';

    /**
     * 活动类型管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '活动类型管理';
        $query = $this->_query($this->table)->like('title');
        $query->equal('status');
        // 加载对应数据列表
        $this->type = input('type', 'all');
        if ($this->type === 'all') {
            $query->where(['is_deleted' => '0', 'status' => '1']);
        } elseif ($this->type = 'recycle') {
            $query->where(['is_deleted' => '0', 'status' => '0']);
        }
        // 列表排序并显示
        $query->order('sort asc, create_at desc, id desc')->page();
    }

    /**
     * 列表数据处理
     * @param $data
     */
    protected function _index_page_filter(&$data)
    {

    }

    /**
     * 添加活动类型
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
     * 编辑活动类型
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
            if (empty($data['activity_time'])) {
                $data['activity_time'] = null;
            }
            // 查重
            $where = ['title' => $data['title'], 'is_deleted' => 0];
            if (isset($data['id']) && $data['id'] > 0) {
                if ($this->app->db->name($this->table)->where($where)->where('id', '<>', $data['id'])->count() > 0) {
                    $this->error("活动类型{$data['title']}已经存在！");
                }
            }else{
                if ($this->app->db->name($this->table)->where($where)->count() > 0) {
                    $this->error("活动类型{$data['title']}已经存在！");
                }
            }
        }
    }

    /**
     * 表单结果处理
     * @param boolean $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            $this->success('恭喜, 活动类型保存成功！');
        } else {
            $this->error('活动类型保存失败, 请稍候再试！');
        }
    }

    /**
     * 修改活动类型状态
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function state()
    {
        $this->_applyFormToken();

        // 禁用可行性判断
        $where = [
            'activity_type_id' => input('id'),
            'is_deleted' => 0
        ];

        if ($this->app->db->name('BusinessActivityResource')->where($where)->count() > 0) {
            return $this->error('禁用失败，该活动类型下存在活动资源数据, 请检查！');
        }

        $this->_save($this->table, ['status' => intval(input('status'))]);
    }

    /**
     * 删除活动类型
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function remove()
    {
        $this->_applyFormToken();
        $this->_delete($this->table);
    }

}
