<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * 微信支付API异常类
 * @author widyhu
 *
 */
class WxpayException extends Exception {
	public function errorMessage()
	{
		return $this->getMessage();
	}
}
