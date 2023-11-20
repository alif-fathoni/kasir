<?php

if(!function_exists('sendRequest')) {

	function sendRequest($url='', $method='', $headers=array(), $body=array(), $file=null)
	{

		$ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		if ($method=='POST' || $method=='post') {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		if ($method=='PUT' || $method=='put') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			if($file){
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			}else{
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
			}
		}
      	curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response =  curl_exec($ch);

		if (curl_errno($ch)) {
		    return curl_error($ch);

		}
		curl_close ($ch);
		return $response;
	}
}

if(!function_exists('sendWhatsApp')) {

    function sendWhatsApp($number, $message)
    {
        $url=getenv('WHACENTER_URL');
        $method='POST';
        $headers=array();
        $body = [
            'device_id' => getenv('WHACENTER_DEVICE_ID'),
            'number' => $number,
            'message' => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if ($method=='POST' || $method=='post') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        if ($method=='PUT' || $method=='put') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            if($file){
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            }else{
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
            }
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response =  curl_exec($ch);

        if (curl_errno($ch)) {
            return curl_error($ch);

        }
        curl_close ($ch);
        return $response;
    }
}

if(!function_exists('sendRequestWithFile')) {

	function sendRequestWithFile($url='', $method='', $headers=array(), $body=array(), $file=null , $filesize=null)
	{

		$ch = curl_init();
      	curl_setopt($ch, CURLOPT_URL, $url);
		if ($method=='POST' || $method=='post') {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		if ($method=='PUT' || $method=='put') {
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			if($file){
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
			}else{
				curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($body));
			}
		}
      	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      	curl_setopt($ch, CURLOPT_INFILESIZE, $filesize);
      	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      	curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
      	//curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$response =  curl_exec($ch);

		if (curl_errno($ch)) {
		    return curl_error($ch);

		}
		curl_close ($ch);
		return $response;
	}
}



if(!function_exists('sendRequestWithJSONDecode')) {

	function sendRequestWithJSONDecode($url='', $method='', $headers=array(), $body=array(), $file=null)
	{
		return json_decode(sendRequest($url, $method, $headers, $body, $file));
	}
}


if(!function_exists('apiRequest')) {

	function apiRequest($url='', $method='', $headers=array(), $body=array(), $file=null)
	{

		$response = sendRequest($url, $method, $headers, $body, $file);
		return json_decode($response);
	}
}

if (!function_exists('errorMessage')) {
	function errorMessage($errors){
		$html_message = '';
		if (isset($errors)){
			if (is_object($errors) || is_array($errors)){
                foreach($errors as $key=>$val){
	                 $html_message .= $val.'<br>';
	            }
            }else{
               $html_message = $errors;
           	}
		}
		
		return $html_message;
	}
}

if (!function_exists('getDayDate')) {
	function getDayDate($day)
	{
		return date('l, d-m-Y', strtotime($day));
	}
}

if (!function_exists('resultMessageJson')) {
	function resultMessageJson($result,$action, $redirect=null){
		if ($result['status'] == 400) {
			
				
				$errors = $result['data']->error_message;

				$msg = [
	                'error' => errorMessage($errors),
	            ];

	           return json_encode($msg);
	    }else if($result->status == 200){

				$msg = [
		            'success' =>  lang('Validation.success_'.$action),
		     	];

		     	if ($redirect != null) {
		     		$msg['redirect'] = $redirect;
		     	}

	       		return json_encode($msg);
	    }else{
	    	$msg = [
		          'error' =>  lang('Validation.error_'.$action),
		    ];

	       	return json_encode($msg);
	    }
	}
}


if (! function_exists('stringToInt')){
    function stringToInt($d) {
        if (is_array($d)) {
            foreach ($d as $k => $v) {
                $d[$k] = stringToInt($v);
            }
        } else if (is_float ($d)) {
            return floatval($d);
        } else if (is_numeric ($d)) {
            return intval($d);
        }
        return $d;
    }
}

if (! function_exists('hashingPassword')){
	function hashingPassword($password){
        $result = false;
        while (empty($result)) {
            $result=password_hash($password, PASSWORD_BCRYPT);
        }

        return $result;
    }
}

if (! function_exists('checkPassword')){
    function checkPassword($password, $hashed_password){
        $result = password_verify($password, $hashed_password);
        return $result;
    }
}

if (! function_exists('phoneValidation')){
    function phoneValidation($phone_number){
        $phone_number = trim($phone_number);
		$phone_number = preg_replace('/[^0-9+]/', '', $phone_number);
        $phone_number = preg_replace('/^(\+?)(620|62|0)(.*)/m', '62$3', $phone_number);

        return $phone_number;
    }
}


if (! function_exists('cleanGlobalPost')){
    function cleanGlobalPost($content){
        $content = preg_replace("/\[vc_btn(.*?)title=\"(.*?)\"(.*?)link=\"url:(.*?)\|\|(.*?)\]/", "<a href='$4' title='$2'></a>", urldecode($content)); 
        $content = preg_replace("/\[(\/*)?vc_(.*?)\]/", '', $content);
        $content = trim(preg_replace('/\s\s+/', ' ', $content));
        $content = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $content);
        $content = preg_replace("/\[embed\](.*?)\[\/embed\]/", "<a href='$1'>Media Link</a>", $content);
        $content = preg_replace("/<a(.*?)href=\"(.*?)\"><img(.*?)src=\"(.*?)\"(.*?)\/><\/a>/", "<a href=\"$2\">Media Link</a>", $content);
        
        $content = str_replace("?", ".", $content);
        //"content" => preg_replace("~(?:\[/?)[^/\]]+/?\]~s", '', $content),
        return $content;
    }
}

if (! function_exists('getCurl')){
    function getCurl($requestURL){
        $ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $requestURL);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$output = curl_exec($ch); 
		curl_close($ch);      
		return $output;
    }

}

if (! function_exists('getDay')){
    function getDay($day)
    {
        $arr_day = array(
            lang("General.sunday"),
            lang("General.monday"),
            lang("General.tuesday"),
            lang("General.wednesday"),
            lang("General.thursday"),
            lang("General.friday"),
            lang("General.saturday"),
        );

        return $arr_day[$day];
    }   
}

if (! function_exists('getMonth')){
    function getMonth($month)
    {
        $arr_month = array(
            "",
            lang("General.january"),
            lang("General.february"),
            lang("General.march"),
            lang("General.april"),
            lang("General.may"),
            lang("General.june"),
            lang("General.july"),
            lang("General.august"),
            lang("General.september"),
            lang("General.october"),
            lang("General.november"),
            lang("General.december"),
        );

        return $arr_month[$month];
    }
}

if (! function_exists('dateToString')){
    function dateToString($date, $day = true){
        $day_text = "";
        if($day){
            $day_text = getDay(date('w', $date)) . ", " ;
        }

        $date_indo =  $day_text . date('d', $date) . " " .  getMonth(date('n', $date)) . " " . date('Y', $date);

        return $date_indo;
    }
}

if (! function_exists('getCurrentTime')){
    function getCurrentTime(){
        return date("Y-m-d H:i:s");
    }
}

if (! function_exists('getTanggal')) {
	function getTanggal($date)
	{
	    $monthName = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

	    $year = substr($date, 0, 4);
	    $month = substr($date, 5, 2);
	    $date   = substr($date, 8, 2);
	    $result = $date . " " . $monthName[(int)$month - 1] . " " . $year;
	    return ($result);
	}
}

if (! function_exists('getTanggalWaktu')){
    function getTanggalWaktu($date){
           $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

           $tahun = substr($date, 0, 4);               
           $bulan = substr($date, 5, 2);
           $tgl   = substr($date, 8, 2);
           $jam   = substr($date, 11, 5);
           $result =  $tgl . " " . $BulanIndo[(int)$bulan-1]. " ". $tahun. ", ". $jam;
           return($result);
    }
}

if (!function_exists('result_message_json')) {
	function result_message_json($result,$action, $redirect=null){
		if ($result->status == 400) {
				
				$errors = $result->data->error_message;

				$msg = [
	                'error' => errorMessage($errors),
	            ];

	           return json_encode($msg);
	    }else if($result->status == 200){

				$msg = [
		            'success' =>  lang('Validation.success_'.$action),
		     	];

		     	if ($redirect != null) {
		     		$msg['redirect'] = $redirect;
		     	}

	       		return json_encode($msg);
	    }else if($result->status == 403){

	    	$msg = [
		           'error' =>  lang('Validation.error_access_forbidden'),
		    ];

	       	return json_encode($msg);
	    }else{
	    	$msg = [
		          'error' =>  lang('Validation.error_'.$action),
		    ];

	       	return json_encode($msg);
	    }
	}
}

if (! function_exists('getResponse')){

    function getResponse(int $status, string $message, array $data, $timer=0, string $format = 'json'){
        $timer->stop('render view');
        $elapsed = $timer->getElapsedTime('render view');

        $payload = [
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "elapsed" => $elapsed
        ];

        //$payload = stringToInt($payload);
        http_response_code($status);
        header('Content-Type: application/json');
        header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
        header('Pragma: no-cache');
        header('Access-Control-Allow-Origin: *');
        echo json_encode($payload);
        exit;           
    }    
}


if (! function_exists('randomString')){

    function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
}

if (! function_exists('getUrl')) {
	function getUrl(){
		return (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
}


if (!function_exists('isDecimal')) {
	function isDecimal( $val )
	{
	    return is_numeric( $val ) && floor( $val ) != $val;
	}
}

if (!function_exists('ifDecimalOrRound')) {
	function ifDecimalOrRound($val)
	{
	    return (isDecimal($val))? $val: round($val);
	}
}

function rupiah($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
 
}