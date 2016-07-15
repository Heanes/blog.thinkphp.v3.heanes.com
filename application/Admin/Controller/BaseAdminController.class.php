<?php
/**
 * @doc Admin公共部分控制器
 * @author Heanes fang <heanes@163.com>
 * @time 2016-07-04 19:42:33 周一
 */
namespace Admin\Controller;
defined('inHeanes') or die('Access denied!');
use Think\Controller;
use Common\Model\SettingCommonModel;
use Common\Component\Page;

require_once(APP_PATH.'Common/utils/func/utils.php');
class BaseAdminController extends Controller{

    /**
     * @var string 公共排除字段
     */
    protected $commonExceptFields = 'is_enable,is_deleted,access_password,insert_time,update_time,create_user,update_user';

    /**
     * @var string 安全性字段
     */
    protected $secretFields = 'access_password,pwd,password';

    /**
     * @var SettingCommonModel 公共设置模型
     */
    protected $settingCommonModel;

    function __construct() {
        parent::__construct();

        $this->settingCommonModel = new SettingCommonModel();
    }

    /**
     * @doc 获取公共设置
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-23 12:26:07 周四
     */
    protected function getSettingCommon() {
        $settingOriginResult = $this->settingCommonModel->select();
        return $settingOriginResult;
    }

    /**
     * @doc 获取设置里的分页大小
     * @author Heanes fang <heanes@163.com>
     * @time 2016-06-23 10:30:33 周四
     */
    protected function getPageCondition() {
        $settingOriginResult = $this->getSettingCommon();
        $page = new Page();
    }
}