<?php


	namespace AppHttp\com;

	class CurlHttp {


		const METHOD_GET = 'GET';
		const METHOD_POST = 'POST';


		/**
		 *  模似用户请求
		 *	@param String $req_url
		 *	@param String $method
		 *	@param Array $param
		 *	@param String $ip
		 *	@param int $connect_time
		 *	@return String
		 *	@throws \Exception
		 */
		public static function fsockopenAnalogUserRequest($req_url,$method='get',$param=array(),$ip='',$connect_time=5) {

			$p = parse_url($req_url); 
			$host = $p['host'];
			$path = isset($p['path'])?$p['path']:'/';
			$ip ==  '' && $ip = $host;
			$port = isset($p['port'])?$p['port']:80;

			$method = strtoupper($method);
			if(!in_array($method,array('GET','POST'))) {
				throw new \Exception('Method Error , Method in Get or Post');
			}

			$param_str = '';
			if(!empty($param)) {
				$param_str = http_build_query($param);	
				$method == 'GET' && $path .= '?' . $param_str;
			}
			

			$fh = fsockopen($ip,$port, $errno, $errstr,$connect_time);
			if($fh == false) {
				throw new \Exception('Connect fail error code '.$error.' error info '.$errstr);
			}else {
				$eof = "\r\n";
				$http = "{$method} {$path} HTTP/1.1{$eof}";
				$http .= "HOST:{$ip}{$eof}";
				$http .= "User-Agent:Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/59.0.3071.115 Safari/537.36{$eof}";
				$http .= "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8{$eof}";
				$http .= "Accept-Language:zh-CN,zh;q=0.8{$eof}";
				$http .= "Connection:keep-alive{$eof}";

				if($method == 'POST') {
					$param_length = strlen($param_str);
					$http .= "Content-Type: application/x-www-form-urlencoded{$eof}";
					$http .= "Content-Length: {$param_length}{$eof}";
				}
				$http .= "{$eof}";
				$http .= $param_str;

				$res = '';
				fwrite($fh,$http);
				while(!feof($fh)) {
					$res .= fgets($fh,4096);
				}
				fclose($fh); 
				return $res;
			}

		}


		/**
	     * 发起http异步请求
	     * @param string $url http地址
	     * @param string $method 请求方式
	     * @param array $params 参数
	     * @param string $ip 支持host配置
	     * @param int $connectTimeout 连接超时，单位为秒
	     * @throws Exception
	     */
	    public static function exec($url, $method = self::METHOD_GET, $params = array(), $ip = null, $connectTimeout = 5)
	    {

	        $urlInfo = parse_url($url);

	        $host = $urlInfo['host'];
	        $port = isset($urlInfo['port']) ? $urlInfo['port'] : 80;
	        $path = isset($urlInfo['path']) ? $urlInfo['path'] : '/';
	        !$ip && $ip = $host;

	        $method = strtoupper(trim($method)) !== self::METHOD_POST ? self::METHOD_GET : self::METHOD_POST; 
	        $params = http_build_query($params);

	        if($method === self::METHOD_GET && strlen($params) > 0){
	            $path .= '?' . $params;
	        }

	        $fp = fsockopen($ip, $port, $errorCode, $errorInfo, $connectTimeout);
	        if($fp === false){
	            throw new Exception('Connect failed , error code: ' . $errorCode . ', error info: ' . $errorInfo);
	        }else{
	                
	            $http  = "$method $path HTTP/1.1\r\n";
	            $http .= "Host: $host\r\n";
	            $http .= "Content-type: application/x-www-form-urlencoded\r\n";
	            $method === self::METHOD_POST && $http .= "Content-Length: " . strlen($params) . "\r\n";
	            $http .= "\r\n";
	            $method === self::METHOD_POST && $http .= $params . "\r\n\r\n";
	            if(fwrite($fp, $http) === false || fclose($fp) === false){
	                throw new Exception('Request failed.');
	            }
	        }
	    }



	}



?>