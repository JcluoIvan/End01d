<?php

    if(!isset($website_style)){     $website_style = "default";         }
    if(!isset($website_JQstyle)){ $website_JQstyle = "black-tie"; }

    define("smarty_path", ROOT_PATH . "lib/smarty/");
    define("themes_path", ROOT_PATH . "theme/".$website_style."/");

    // 載入Smarty Lib
    require(LIBRARIES_PATH . '/smarty/libs/Smarty.class.php');

    // 建立 Smarty 物件 並設定相關 路徑 與 設定
    $tpl = new Smarty;
    $tpl->left_delimiter = "{{";
    $tpl->right_delimiter = "}}";

    $tpl->debugging = false;
    $tpl->setTemplateDir(themes_path);
    $tpl->setCacheDir(themes_path."cache/");
    $tpl->setCompileDir(themes_path."templates_c/");

    // 從TPL設定JQ路徑
    $tpl->assign("CSS_path",    ROOT_PATH . "theme/".$website_style."/style/");
    $tpl->assign("IMG_path",    ROOT_PATH . "theme/".$website_style."/images/");
    $tpl->assign("JQCSS_path",  ROOT_PATH . "theme/jq/".$website_JQstyle."/");

    // 載入語系
    // include_once(publ_path."publang_zhtw.php");