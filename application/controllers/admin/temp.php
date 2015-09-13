<?php

function doCurl($url, $options = array())
  {
      $headers = isset($options['headers']) && is_array($options['headers']) ? $options['headers'] : null;
      // Initialize cURL
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_POST, 0);
      //curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

      if (!empty($headers)) {
      //debug($headers);
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      }

      $response_json = curl_exec($ch);
      //debug(curl_error($ch));
      //debug(curl_getinfo($ch));
      curl_close($ch);

      return $response_json;
  }
  
  
    $tag = '99points';
    $client_id = "20fedafd752f4516995ec9c50027a41b";
    $url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$client_id;
 
    $all_result  = doCurl($url);
    $decoded_results = json_decode($all_result, true);
 
     echo '<pre>';
     print_r($decoded_results);
     exit;
 
    //Now parse through the $results array to display your results... 
    foreach($decoded_results['data'] as $item){
        $image_link = $item['images']['thumbnail']['url'];
        echo '<img src="'.$image_link.'" />';
	}	
?>