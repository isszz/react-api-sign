<?php

class SignSrv {

	public static $secret = 'ergweyh45t345t34t34';
    
	public static function sign($data = []) {
		if (empty($data)) {
			return '';
		}
	    ksort($data);
	    $string = self::toUrlParams($data) . '&secret=' . self::$secret;
		$string = md5($string);
		return strtoupper($string);
	}
    
	public static function check() {
		$data = array_merge($_GET, $_POST);
	    if (isset($data['sign'])) {
	        return self::sign($data) === $data['sign'];
	    } else {
	        return false;
	    }
	}
    
	public static function toUrlParams($data = []) {
		$buff = '';
		foreach ($data as $k => $v) {
			if($k != 'sign' && $v != '' && !is_array($v)){
				$buff .= $k . '=' . $v . '&';
			}
		}
		$buff = trim($buff, '&');
		return $buff;
	}
}
