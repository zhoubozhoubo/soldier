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

namespace app\wechat\controller;

use app\wechat\service\FansInfoService;
use app\wechat\service\WechatService;
use think\admin\Controller;
use think\exception\HttpResponseException;

/**
 * 微信用户管理
 * Class Fans
 * @package app\wechat\controller
 */
class Fans extends Controller
{
    /**
     * 绑定数据表
     * @var string
     */
    protected $table = 'WechatFans';

    /**
     * 微信用户管理
     * @auth true
     * @menu true
     * @throws \think\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '微信用户管理';
        $query = $this->_query($this->table)->like('nickname');
        $query->equal('is_realname');
        $query->dateBetween('create_at')->order('create_at desc')->page();
    }

    /**
     * 列表数据处理
     * @param $data
     */
    protected function _index_page_filter(&$data)
    {
        foreach ($data as &$vo) {
            $fansInfo = FansInfoService::instance()->getFansInfo($vo['id']);
            $vo['name'] = $fansInfo['name'];
            $vo['phone'] = $fansInfo['phone'] ? substr_replace($fansInfo['phone'],'****',3,4) : '';
            $vo['id_number'] = $fansInfo['id_number'] ? substr_replace($fansInfo['id_number'],'****',3) : '';
        }
    }


    /**
     * 同步用户数据
     * @auth true
     */
    public function sync()
    {
        $this->_queue('同步微信用户数据', "xadmin:fansall", 1, [], 0);
    }

    /**
     * 用户拉入黑名单
     * @auth true
     */
    public function black_add()
    {
        try {
            $this->_applyFormToken();
            foreach (array_chunk(explode(',', $this->request->post('openid')), 20) as $openids) {
                WechatService::WeChatUser()->batchBlackList($openids);
                $this->app->db->name('WechatFans')->whereIn('openid', $openids)->update(['is_black' => '1']);
            }
            $this->success('拉入黑名单成功！');
        } catch (HttpResponseException $exception) {
            throw  $exception;
        } catch (\Exception $e) {
            $this->error("拉入黑名单失败，请稍候再试！<br>{$e->getMessage()}");
        }
    }

    /**
     * 用户移出黑名单
     * @auth true
     */
    public function black_del()
    {
        try {
            $this->_applyFormToken();
            foreach (array_chunk(explode(',', $this->request->post('openid')), 20) as $openids) {
                WechatService::WeChatUser()->batchUnblackList($openids);
                $this->app->db->name('WechatFans')->whereIn('openid', $openids)->update(['is_black' => '0']);
            }
            $this->success('移出黑名单成功！');
        } catch (HttpResponseException $exception) {
            throw  $exception;
        } catch (\Exception $e) {
            $this->error("移出黑名单失败，请稍候再试！<br>{$e->getMessage()}");
        }
    }

    /**
     * 删除用户信息
     * @auth true
     * @throws \think\db\exception\DbException
     */
    public function remove()
    {
        $this->_applyFormToken();
        $this->_delete($this->table);
    }

}
