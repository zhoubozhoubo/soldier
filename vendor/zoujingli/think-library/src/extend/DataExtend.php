<?php

// +----------------------------------------------------------------------
// | ThinkAdmin
// +----------------------------------------------------------------------
// | 版权所有 2014~2020 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: https://gitee.com/zoujingli/ThinkLibrary
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | gitee 代码仓库：https://gitee.com/zoujingli/ThinkLibrary
// | github 代码仓库：https://github.com/zoujingli/ThinkLibrary
// +----------------------------------------------------------------------

namespace think\admin\extend;

/**
 * 数据处理扩展
 * Class DataExtend
 * @package think\admin\extend
 */
class DataExtend
{

    /**
     * 一维数组生成数据树
     * @param array $list 待处理数据
     * @param string $cid 自己的主键
     * @param string $pid 上级的主键
     * @param string $sub 子数组名称
     * @return array
     */
    public static function arr2tree($list, $cid = 'id', $pid = 'pid', $sub = 'sub')
    {
        list($tree, $tmp) = [[], array_combine(array_column($list, $cid), array_values($list))];
        foreach ($list as $vo) isset($vo[$pid]) && isset($tmp[$vo[$pid]]) ? $tmp[$vo[$pid]][$sub][] = &$tmp[$vo[$cid]] : $tree[] = &$tmp[$vo[$cid]];
        unset($tmp, $list);
        return $tree;
    }

    /**
     * 一维数组生成数据树
     * @param array $list 待处理数据
     * @param string $cid 自己的主键
     * @param string $pid 上级的主键
     * @param string $cpath 当前 PATH
     * @param string $ppath 上级 PATH
     * @return array
     */
    public static function arr2table(array $list, $cid = 'id', $pid = 'pid', $cpath = 'path', $ppath = '')
    {
        $tree = [];
        foreach (self::arr2tree($list, $cid, $pid) as $attr) {
            $attr[$cpath] = "{$ppath}-{$attr[$cid]}";
            $attr['sub'] = $attr['sub'] ?? [];
            $attr['spt'] = substr_count($ppath, '-');
            $attr['spl'] = str_repeat("　├　", $attr['spt']);
            $sub = $attr['sub'];
            unset($attr['sub']);
            $tree[] = $attr;
            if (!empty($sub)) $tree = array_merge($tree, self::arr2table($sub, $cid, $pid, $cpath, $attr[$cpath]));
        }
        return $tree;
    }

    /**
     * 获取数据树子ID
     * @param array $list 数据列表
     * @param integer $id 起始ID
     * @param string $key ID_KEY
     * @param string $pkey PID_KEY
     * @return array
     */
    public static function getArrSubIds($list, $id = 0, $key = 'id', $pkey = 'pid')
    {
        $ids = [intval($id)];
        foreach ($list as $vo) if (intval($vo[$pkey]) > 0 && intval($vo[$pkey]) === intval($id)) {
            $ids = array_merge($ids, self::getArrSubIds($list, intval($vo[$key]), $key, $pkey));
        }
        return $ids;
    }
}