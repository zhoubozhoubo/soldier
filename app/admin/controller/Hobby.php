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
 * 军事爱好管理
 * Class Hobby
 * @package app\admin\controller
 */
class Hobby extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessHobby';

    /**
     * 军事爱好管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '军事爱好管理';
        $query = $this->_query($this->table)->like('name');
        // 加载对应数据列表
        $this->type = input('type', 'all');
        if ($this->type === 'all') {
            $query->where(['is_deleted' => '0', 'status' => '1']);
        } elseif ($this->type = 'recycle') {
            $query->where(['is_deleted' => '0', 'status' => '0']);
        }
        // 列表排序并显示
        $query->order('sort asc, time desc, create_at desc, id desc')->page();
    }

    /**
     * 添加军事爱好
     * @auth true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function add()
    {
        if ($this->request->isGet()) {
            $this->title = '新建军事爱好';
            $this->fetch('form');
        } else {
            $postData = $this->request->post();
            if (empty($postData['time'])) {
                $postData['time'] = null;
            }
            if ($this->app->db->name($this->table)->insert($postData) !== false) {
                $this->success('军事爱好添加成功！', 'javascript:history.back()');
            } else {
                $this->error('军事爱好添加失败，请稍候再试！');
            }
        }
    }

    /**
     * 编辑军事爱好
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

            $this->title = '编辑军事爱好';
            $this->assign('vo', $data);
            $this->fetch('form');
        } else {
            $postData = $this->request->post();
            if (empty($postData['time'])) {
                $postData['time'] = null;
            }
            if ($this->app->db->name($this->table)->update($postData) !== false) {
                $this->success('军事爱好编辑成功！', 'javascript:history.back()');
            } else {
                $this->error('军事爱好编辑失败，请稍候再试！');
            }
        }
    }

    /**
     * 修改军事爱好状态
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function state()
    {
        $this->_applyFormToken();
        $this->_save($this->table, ['status' => intval(input('status'))]);
    }

    /**
     * 删除军事爱好
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function remove()
    {
        $this->_applyFormToken();
        $this->_delete($this->table);
    }

}
