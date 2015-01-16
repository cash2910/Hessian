<?php 


set_time_limit(0);

require_once ( dirname(__FILE__) . DIRECTORY_SEPARATOR .'config.php' );

// Hessian 扩展及配置文件
require_once ( PATH . 'extensions/Hessian/HessianClient.php' );
require_once ( PATH . 'class/HessianApi.php' );

// 调用 server.php 方法
require_once ( PATH . 'class/Goods.php');

// 请求接口获取数据
$goods = new Goods( HESSIAN_URL );

// 设置商品标题 , 价格.
$title = 'jzx';
$price = '50';

// 请求Hessian协议
$goodsInfo = $goods->getGoodsInfomation( (string) $title , (int) $price );

// 打印请求结果
echo ( $goodsInfo );

?>