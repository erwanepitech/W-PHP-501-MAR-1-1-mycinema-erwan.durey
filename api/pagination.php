<?php

function pagination (&$nbArticles, &$pages, &$currentPage, &$parPage) {

    // On détermine le nombre d'articles par page

    if (isset($_GET['nombre'])) {

        if ($_GET['nombre'] == "10") {

            $parPage = 10;

        } elseif ($_GET['nombre'] == "20") {

            $parPage = 20;

        } elseif ($_GET['nombre'] == "30") {

            $parPage = 30;
        
        } elseif ($_GET['nombre'] == "40") {

            $parPage = 40;

        } elseif ($_GET['nombre'] == "50") {

            $parPage = 50;

        } else {

            $parPage = 10;

        }

    }

    if (isset($_GET['page']) && !empty($_GET['page'])) {

        $currentPage = (int) strip_tags($_GET['page']);

    } else {

        $currentPage = 1;

    }

    if (isset($_GET['nombre']) && $nbArticles >= $_GET['nombre']) {

        $url = $_SERVER['REQUEST_URI'];
        $url_parts = parse_url($url);

        $tmp = [];

        for($p=1, $i=0; $i < $nbArticles; $p++, $i += $parPage) {

            if (isset($url_parts['query'])) { 

                parse_str($url_parts['query'], $params);

            } else {

                $params = array();

            }
            
            $params['page'] = $p;
            $url_parts['query'] = http_build_query($params);
            $url = $url_parts['path'] . "?". $url_parts['query'];

            if ($currentPage == $p) {
          
                $tmp[] = "<a id=\"active\" href=\"{$url}\">{$p}</a>";

            } else {

                $tmp[] = "<a href=\"{$url}\">{$p}</a>";

            }

        }

        for($i = count($tmp) - 3; $i > 1; $i--) {

          if(abs($currentPage - $i - 1) > 2) {

            unset($tmp[$i]);

          }

        }


        if($currentPage > 1) {

            if (isset($url_parts['query'])) {

                parse_str($url_parts['query'], $params);

            } else {

                $params = array();

            }

            $params['page'] = ($currentPage - 1);
            $url_parts['query'] = http_build_query($params);
            $url = $url_parts['path'] . "?". $url_parts['query'];

          echo "<a href=\"{$url}\">&lsaquo;</a>";
        }

        $lastlink = 0;
        foreach($tmp as $i => $link) {

          echo $link;
          $lastlink = $i;

        }

        if($currentPage <= $lastlink) {

            if(isset($_GET['page'])){

                if (isset($url_parts['query'])) { 

                    parse_str($url_parts['query'], $params);

                } else {

                    $params = array();

                }

                $params['page'] = ($currentPage + 1);
                $url_parts['query'] = http_build_query($params);
                $url = $url_parts['path'] . "?". $url_parts['query'];

                echo " <a href=\"{$url}\">&rsaquo;</a>";

            } else {

                if (isset($url_parts['query'])) { 

                    parse_str($url_parts['query'], $params);

                } else {

                    $params = array();

                }

                $params['page'] = ($currentPage + 1);
                $url_parts['query'] = http_build_query($params);
                $url = $url_parts['path'] . "?". $url_parts['query'];

                echo " <a href=\"{$url}\">&rsaquo;</a>";

            }
        }

    }
    
}