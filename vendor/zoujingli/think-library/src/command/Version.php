<?php

// +----------------------------------------------------------------------
// | Library for ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2020 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: https://gitee.com/zoujingli/ThinkLibrary
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee 仓库地址 ：https://gitee.com/zoujingli/ThinkLibrary
// | github 仓库地址 ：https://github.com/zoujingli/ThinkLibrary
// +----------------------------------------------------------------------

namespace think\admin\command;

use think\admin\Command;
use think\console\Input;
use think\console\Output;

/**
 * 框架版本号指令
 * Class Version
 * @package think\admin\command
 */
class Version extends Command
{
    protected function configure()
    {
        $this->setName('xadmin:version');
        $this->setDescription("ThinkLibrary and ThinkPHP Version for ThinkAdmin");
    }

    /**
     * @param Input $input
     * @param Output $output
     */
    protected function execute(Input $input, Output $output)
    {
        $output->writeln('ThinkLib ' . $this->process->version());
        $output->writeln('ThinkPHP ' . $this->app->version());
    }
}