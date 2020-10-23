<?php

  require './php/threads.php';
  require './data.php';

  function viewer($cam,$size)
  {
      Header('Accept-Ranges:bytes');
      Header('Connection:keep-alive');
      Header('Content-type: multipart/x-mixed-replace;boundary=ffserver');
      passthru('ffmpeg -rtsp_transport tcp -i "' . $cam . '"   -r 10 -b:v 640k -crf 50 -s ' . $size . ' -f mpjpeg pipe:');
      echo $cam;
      viewer($cam,$size);
  }

  if (isset($_REQUEST["get"])){
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $str = parse_url($url, PHP_URL_QUERY);
    parse_str($str, $params);
    $watget = 'empty';
    $watget = $params['get'];
    $cam = $ipcam[$params['cam']];
    $size = $params['qty'];
    if($watget !== 'empty'){
      viewer($cam,$size);
    }
  }

?>
