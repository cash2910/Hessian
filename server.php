<?php
/**
 * 文件名		: server.php
 * 创建人		: 吴佰清
 * 创建时间	: 2012-05-09 11:54
 *
 * 参考资料	:
 * 1.http://hessian.caucho.com/ ( Hessian主页 )
 * 2.http://hessianphp.sourceforge.net/ ( Hessian PHP )
 * 3.http://sourceforge.net/projects/hessianphp/ ( Hessian PHP开源 )
 * 4.http://baike.baidu.com/view/1859857.htm ( 单例模式 )
 *
 * @author wubaiqing <wbqyyicx@gmail.com>
 * @package system.core applied to the whole site
 * @copyright Copyright (c) 2012
 * @since 1.0
 */
require_once ( dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php' );
require_once ( PATH . 'extensions/Hessian/HessianService.php' );
file_put_contents('aaa.txt', file_get_contents('php://input'), FILE_APPEND );
set_time_limit(3600);
error_reporting(0);
class HessianServer
{
	public function __construct() {}
	/**
	 * 商品详细信息APi接口
	 * @param string $title 标题
	 * @param int $price 价格
	 */
	public function goodsInfomationApi( $title , $price ) {
		$price = (int) $price;
		return 'return:'.$title.$price;
	}
}

$server = new HessianService(  );
$server->registerObject( new HessianServer() );
//$server->displayInfo();
$server->service();

// IDE : Zend Studio 9.0
// IDE Extension : Toggle Vrapper
?>