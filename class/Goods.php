<?php
/**
 * 类名		: Goods
 * 继承类		: HessianApi
 * 创建人		: 吴佰清
 * 创建时间	: 2012-05-09 12:12
 * 用途		: 调用server.php方法
 *
 * @author wubaiqing <wbqyyicx@gmail.com>
 * @package system.core.code applied to the whole site
 * @copyright Copyright (c) 2012 
 * @since 1.0
 */
class Goods extends HessianApi
{
	/**
	 * 设置接口地址
	 * @param string $url
	 */
	public function __construct( $url ) {
		parent::__construct( $url );
	}

	/**
	 * 获取商品信息
	 * 调用server.php文件中的goodsInfomationApi方法
	 * @param string $title 标题
	 * @param string $title 价格
	 */
	public function getGoodsInfomation( $title , $price )
	{
		// 如果调用java平台的hessian服务 需要指定你传递参数的类型,特别是整形和字符串.
		$price = (int) $price; 
		
		$result = $this->getHandler()->goodsInfomationApi( $title , $price );
		$this->resultLog( 'getGoodsInfomation' , '访问接口,但接口没有进行逻辑验证.');
		return $result;
	}
}

// IDE : Zend Studio 9.0
// IDE Extension : Toggle Vrapper
?>