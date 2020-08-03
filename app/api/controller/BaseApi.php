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

use think\admin\Controller;
use think\App;

/**
 * Api基类
 * Class BaseApi
 * @package app\api\controller
 */
class BaseApi extends Controller
{
    public $page = 1;
    public $size = 10;

    public $id;

    public $token;

    public $fans;
    public $currentFansId;

    public function __construct(App $app)
    {
        header('Access-Control-Allow-Headers: token');

        $this->app = $app;

        if (isset($_SERVER['HTTP_TOKEN']) && !empty($_SERVER['HTTP_TOKEN'])) {
            $this->token = $_SERVER['HTTP_TOKEN'];
        }

        if (isset($this->token) && !empty($this->token)) {
            $this->fans = json_decode(session($this->token), true);
            $this->currentFansId = $this->fans['id'];
        }

        if (!$this->fans) {
            return $this->error('未登录，请先登录');
        }

        parent::__construct($app);
    }

    protected function initialize()
    {
        $getData = $this->request->get();

        if (isset($getData['size']) && !empty($getData['size'])) {
            $this->size = $getData['size'];
        }
        if (isset($getData['page']) && !empty($getData['page'])) {
            $this->page = $getData['page'];
        }

        if (isset($getData['id']) && !empty($getData['id'])) {
            $this->id = $getData['id'];
        }
    }

    public function BaseAll($table, $where = [], $order = 'create_at desc')
    {
        if (!$this->request->isGet()) {
            return $this->error('请求方式错误');
        }

        $where['is_deleted'] = 0;
        $where['status'] = 1;

        $list = $this->app->db->name($table)->where($where)->order($order)->select();
        $count = $this->app->db->name($table)->where($where)->count();

        $content = [
            'list' => $list,
            'count' => $count,
        ];

        return $content;
    }

    public function BasePage($table, $where = [], $order = 'create_at desc')
    {
        if (!$this->request->isGet()) {
            return $this->error('请求方式错误');
        }

        $where['is_deleted'] = 0;
        $where['status'] = 1;

        $list = $this->app->db->name($table)->where($where)->order($order)->page($this->page, $this->size)->select();
        $count = $this->app->db->name($table)->where($where)->count();
        $pages = ceil($count/$this->size);

        $content = [
            'list' => $list,
            'count' => $count,
            'pages' => $pages,
            'page' => $this->page,
            'size' => $this->size
        ];

        return $content;
    }

    public function BaseDetails($table)
    {
        if (!$this->request->isGet()) {
            return $this->error('请求方式错误');
        }

        if ($this->id) {
            $where['is_deleted'] = 0;
            $where['status'] = 1;

            return $this->app->db->name($table)->where($where)->find($this->id);
        } else {
            return false;
        }
    }

    public function returnSuccess($data = [], $msg = '操作成功')
    {
        $result = [
            'code' => 200,
            'data' => $data,
            'msg' => $msg
        ];

        return json($result);
    }

    public function returnError($msg = '请求失败', $code = 500)
    {
        $result = [
            'code' => $code,
            'msg' => $msg
        ];

        return json($result);
    }

}
