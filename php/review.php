<?php

  require './php/threads.php';

  if ($params = Threads::getParams())
    switch ($params['countCam']) {
      case 'some':
                    echo '<div class="col-md-' . round(12 / round($params['ncams'] / 2, 0, PHP_ROUND_HALF_DOWN)) . '">';
                    echo '<h5 align="middle">' . $params['namecam'] . '</h5>';
                    echo '<div class="imgload"><img ondblclick="location.href=\'?get=' . $params['grcam'] . '_' . $params['n'] . '&qty=1280x960\'" class="img-responsive center-block" src="./php/cam.php?get=' . $params['grcam'] . '_' . $params['n'] . '&qty=' . $params['size'] . '"  /></div>';
                    echo '</div>';
                    break;
      case 'one':
                    echo '<div class="col-md-12">';
                    echo '<h5 align="middle">' . $params['namecam'] . '</h5>';
                    echo '<div class="imgload"><img class="img-responsive center-block" src="./php/cam.php?get=' . $params['cam'] . '&qty=' . $params['size'] . '"  /></div>';
                    echo '</div>';
                    break;
    }

 ?>
