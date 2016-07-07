<?php
/**
 * @doc 文章相关控制器
 * @author Heanes fang <heanes@163.com>
 * @time 2016-06-21 14:44:18 周二
 */
namespace Home\Controller;
class ArticleCategoryController extends BaseHomeController {

    /**
     * @doc 默认页面
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-21 14:16:12 周二
     */
    public function indexOp(){
        $this->display('index');
    }

    /**
     * @doc 显示文章分类列表
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-21 14:45:47 周二
     */
    public function listOp() {
        $this->display('list');
    }

    /**
     * @doc 显示文章分类详情
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-21 14:46:05 周二
     */
    public function detailOp() {
        $this->display('detail');
    }
}