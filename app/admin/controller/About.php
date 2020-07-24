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
use think\admin\service\SystemService;

/**
 * 关于配置
 * Class About
 * @package app\admin\controller
 */
class About extends Controller
{

    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'SystemConfig';

    /**
     * 关于配置
     * @auth true
     * @menu true
     */
    public function index()
    {
        $this->title = '关于军人e家';
        $this->fetch();
    }

    /**
     * 修改关于
     * @auth true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function system()
    {
        $this->_applyFormToken();
        if ($this->request->isGet()) {
            $this->title = '修改关于军人e家';
            $this->fetch();
        } else {
            if ($xpath = $this->request->post('xpath')) {
                if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]+$/', $xpath)) {
                    $this->error('后台入口名称需要是由英文字母开头！');
                }
                if ($xpath !== 'admin' && file_exists($this->app->getBasePath() . $xpath)) {
                    $this->error("后台入口名称{$xpath}已经存在应用！");
                }
                SystemService::instance()->setRuntime([$xpath => 'admin']);
            }
            foreach ($this->request->post() as $name => $value) sysconf($name, $value);
            $this->success('修改关于军人e家成功！');
        }
    }

}
