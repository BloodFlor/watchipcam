<?php

  require './php/threads.php';
  require './php/data.php';

  echo '<!DOCTYPE html><html lang="ru"><head>';
  include_once "html/head.html";
  echo '</head>';

  echo '<body>';
  include_once "html/body.html";

  $cam = 'empty';
  if (isset($_REQUEST["get"]))
  {
    $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $str = parse_url($url, PHP_URL_QUERY);
    parse_str($str, $params);
    $cam = $params['get'];
    $size = $params['qty'];

    if ($cam !== 'empty')
    {
      $threads = new Threads;
      if(!stristr($cam,'_'))
      {
        $title = $namegroupcam[$cam];
        $ncams = 0;
        foreach ($numcam[$cam] as $grcam)
          $ncams += $numcam[$grcam];

        if($cam == 'Biro' or $cam == 'All' or $cam == 'Kukan')
          foreach ($numcam[$cam] as $grcam)
            for($i = 0; $i < $numcam[$grcam]; $i++)
            {
              $threads->newThread('./php/review.php', array('countCam' => 'some', 'n' => ($i + 1), 'ncams' => $ncams, 'grcam' => $grcam, 'namecam' => $namecam[$grcam . '_' . ($i + 1)], 'size' => $size));
              echo $threads->iteration();
            }
        else
          for($i = 0; $i < $numcam[$cam]; $i++)
          {
            $threads->newThread('./php/review.php', array('countCam' => 'some', 'n' => ($i + 1), 'ncams' => $numcam[$cam], 'grcam' => $cam, 'namecam' => $namecam[$cam . '_' . ($i + 1)], 'size' => $size));
            echo $threads->iteration();
          }
        }
      else
      {
        $title = $namecam[$cam];
        $threads->newThread('./php/review.php', array('countCam' => 'one', 'cam' => $cam, 'namecam' => $namecam[$cam], 'size' => $size));
        echo $threads->iteration();
      }

        echo '<script type="text/javascript">';
        echo '  document.title = "' . $title . '";';
        echo '</script>';
      }
   }

  echo '</body>';


    function OneCam($cam, $namecam, $size)
    {
      echo '<div class="col-md-12">';
      echo '<h5 align="middle">' . $namecam . '</h5>';
      echo '<div class="imgload"><img class="img-responsive center-block" src="./php/cam.php?get=' . $cam . '&qty=' . $size . '"  /></div>';
      echo '</div>';
    }
    function GroupCam($n, $ncams, $grcam, $namecam, $size)
    {$n+=1;

      $threads = new Threads;
      $threads->newThread('./php/review.php', array('n' => $n, 'ncams' => $ncams, 'grcam' => $grcam, 'namecam' => $namecam, 'size' => $size));
      echo $threads->iteration();
    }
?>
