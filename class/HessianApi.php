<?php
/**
 * 类名		: HessianApi
 * 创建人		: 吴佰清
 * 创建时间	: 2012-05-08 18:00
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
class HessianApi
{
	/**
	 * @var string 接口地址
	 */
	private $_url = NULL;
	
	/**
	 * @var result 句柄
	 */
	private $_handle = NULL;

	/**
	 * @var array 存放单例模式数组
	 */
	private static $_objects = array();

	/**
	 * 设置URL地址
	 * 实例化HessianClient类
	 * 参数	: (1) url地址 , 2
	 * 
	 * 2.Java调用字段
	 * @param string $url
	 */
	public function __construct( $url )
	{
		$this->setUrl( $url );
		$handler = new HessianClient ( $this->getUrl (), $this->getOptions () );
		$this->setHandler ( $handler );
	}

	/**
	 * @return result $_handle 句柄
	 */
	public function getHandler() {
		return $this->_handle;
	}

	/**
	 * 设置句柄
	 * @param result $_handle
	 */
	public function setHandler($_handle) {
		$this->_handle = $_handle;
	}

	/**
	 * 获取URL地址
	 */
	public function getUrl() {
		return $this->_url;
	}

	/**
	 * 设置URL地址
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->_url = $url;
	}

	/**
	 * typeMap映射Java等平台对象
	 * @return array
	 */
	public function getOptions() {
		return array ('version' => 1, 'saveRaw' => TRUE, 'typeMap' => array('JavaNullPointException' => 'java.lang.NullPointerException' ,'StackTraceElement' => 'java.lang.StackTraceElement') );
	}

	/**
	 * 记录接口调用信息
	 * @param string $method 调用的方法
	 * @param string $returnMsg 需要记入log的文字信息
	 */
	public function resultLog( $method , $returnMsg )
	{
		$logPath = PATH.'/runtime/hessian/';
		if( !is_dir( $logPath ) ) {
			mkdir($logPath,0777);
		}
		error_log(date('Ymd H:i:s', time()) . '|' . $method . '|' . $returnMsg."\n", 3, $logPath . date('Y-m-d', time()) . '.log');
	}

	/**
	 * 静态工厂方法，生成单个URL的唯一实例
	 * @param string $url
	 */
	public static function start( $url )
	{
		$key = md5( $url );
		
		if ( isset(self::$_objects[$key]) ) {
			return self::$_objects[$key];
		}
		
		self::$_objects[$key] = new HessianApi( $url );
		return self::$_objects[$key];
	}
}

class JavaNullPointException extends Exception {}

class StackTraceElement extends Exception {}

// IDE : Zend Studio 9.0
// IDE Extension : Toggle Vrapper

?>