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

use app\admin\service\ConsultService;
use app\wechat\service\FansService;
use think\admin\Controller;

/**
 * 咨询信息管理
 * Class Consult
 * @package app\admin\controller
 */
class Consult extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    public $table = 'BusinessConsult';

    /**
     * 咨询信息管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '咨询信息管理';
        $query = $this->_query($this->table)->like('comment');
        $query->equal('is_answered');
        // 加载对应数据列表
        $this->type = input('type', 'all');
        if ($this->type === 'all') {
            $query->where(['is_deleted' => '0', 'status' => '1']);
        } elseif ($this->type = 'recycle') {
            $query->where(['is_deleted' => '0', 'status' => '0']);
        }
        // 列表排序并显示
        $query->order('create_at desc, id desc')->page();
    }

    /**
     * 列表数据处理
     * @param $data
     */
    protected function _index_page_filter(&$data)
    {
        foreach ($data as &$vo) {
            $vo['fans_nickname'] = FansService::instance()->getNicknameById($vo['wechat_fans_id']);
        }
    }

    /**
     * 编辑咨询信息
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

    }

    /**
     * 表单结果处理
     * @param boolean $result
     */
    protected function _form_result($result)
    {
        if ($result !== false) {
            $consult = [
                'id'=>$result,
                'is_answered'=>1
            ];
            ConsultService::instance()->set($consult);
            $this->success('恭喜, 回复成功！');
        } else {
            $this->error('回复失败, 请稍候再试！');
        }
    }

    /**
     * 修改咨询信息状态
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function state()
    {
        $this->_applyFormToken();
        $this->_save($this->table, ['status' => intval(input('status'))]);
    }

    /**
     * 删除咨询信息
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function remove()
    {
        $this->_applyFormToken();
        $this->_delete($this->table);
    }

}
