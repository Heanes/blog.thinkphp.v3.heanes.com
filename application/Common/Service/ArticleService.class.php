<?php
/**
 * @doc 文章相关服务
 * @author Heanes
 * @time 2017-09-10 19:56:43 周日
 */

namespace Common\Service;
defined('InHeanes') or die('Access denied!');

use Common\Model\ArticleModel;
use Common\Model\ArticleCategoryModel;

class ArticleService extends BaseService{

    /**
     * @var ArticleModel 文章模型
     */
    private $articleModel;

    /**
     * @var ArticleCategoryModel 文章分类模型
     */
    private $articleCategoryModel;

    function __construct() {
        parent::__construct();
        $this->articleModel = new ArticleModel();
        $this->articleCategoryModel = new ArticleCategoryModel();
    }

    /**
     * @doc 列表页
     * @param array $param 查询参数
     * @param string $resultStyle 结果风格，驼峰或者原生
     * @return array
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-21 14:56:00 周二
     */
    public function getList($param, $resultStyle = RESULT_STYLE_CAMEL){
        // 0. 查询文章基本数据
        $articleListRaw = $this->articleModel->getList($param);

        // 遍历一次得到相关备查数据
        if(empty($articleListRaw)){
            return [];
        }

        $articleCategoryIdList = [];
        foreach ($articleListRaw['items'] ?: $articleListRaw as $index => $item) {
            $articleCategoryIdList[] = $item['category_id'];
        }
        $articleCategoryIdList = array_unique($articleCategoryIdList);

        // 1. 查询文章分类信息
        $articleCategoryParam = [];
        $articleCategoryParam['id'] = ['in', $articleCategoryIdList];

        $articleCategoryService = new ArticleCategoryService();
        $articleCategoryListRaw = $articleCategoryService->getList($articleCategoryParam);
        var_dump($articleCategoryListRaw);
        // 2. 查询文章标签信息

        // ---- 数据后续加工处理

        // 如果是驼峰格式
        if($resultStyle == RESULT_STYLE_CAMEL){
            $articleListResult = convertToCamelStyle($articleListRaw);
        }else{
            $articleListResult = $articleListRaw;
        }

        return $articleListResult;
    }

    /**
     * @doc 列表页
     * @param array $param 查询参数
     * @param string $resultStyle 结果风格，驼峰或者原生
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-21 14:56:00 周二
     * @return array|null|string
     */
    public function getDetailById($id, $param, $resultStyle = RESULT_STYLE_CAMEL){
        $param['where']['id'] = $id;
        $articleRaw = $this->articleModel->getOne($param);
        if($articleRaw == null || count($articleRaw) == 0){
            return [];
        }
        // 数据后续加工处理
        $articleRaw['publish_time_formative'] = date(DATE_TIME_FORMATIVE_DEFAULT, $articleRaw['publish_time']);

        if($resultStyle == RESULT_STYLE_CAMEL){
            $articleResult = convertToCamelStyle($articleRaw);
            return $articleResult;
        }
        return $articleRaw;
    }

}