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
 * 退役军人信息管理
 * Class Soldier
 * @package app\admin\controller
 */
class Soldier extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessSoldier';

    /**
     * 退役军人信息管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '退役军人信息管理';
        $query = $this->_query($this->table)->like('name');
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
     * 添加退役军人信息
     * @auth true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add()
    {
        if ($this->request->isGet()) {
            $this->title = '新建退役军人信息';
            $this->fetch('form');
        } else {
            $postData = $this->request->post();
            if ($this->app->db->name($this->table)->insert($postData) !== false) {
                $this->success('退役军人信息添加成功！', 'javascript:history.back()');
            } else {
                $this->error('退役军人信息添加失败，请稍候再试！');
            }
        }
    }

    /**
     * 编辑退役军人信息
     * @auth true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function edit()
    {
        if ($this->request->isGet()) {
            $this->id = $this->request->get('id');
            $data = $this->app->db->name($this->table)->find($this->id);

            $this->title = '编辑退役军人信息';
            $this->assign('vo', $data);
            $this->fetch('form');
        } else {
            $postData = $this->request->post();
            if ($this->app->db->name($this->table)->update($postData) !== false) {
                $this->success('退役军人信息编辑成功！', 'javascript:history.back()');
            } else {
                $this->error('退役军人信息编辑失败，请稍候再试！');
            }
        }
    }

    /**
     * 修改退役军人信息状态
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function state()
    {
        $this->_applyFormToken();
        $this->_save($this->table, ['status' => intval(input('status'))]);
    }

    /**
     * 删除退役军人信息
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function remove()
    {
        $this->_applyFormToken();
        $this->_delete($this->table);
    }

}
