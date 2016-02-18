<?php

	include '../../conf/config.php';
    use model\Agent;
    use model\Store;
    use model\Post;
    use model\Bank;

    $pid = Input::get('pid') ?: 0;
    $id = Input::get('id') ?: 0;

    $agent = $id ? Agent::find_by_age001($id) : new Agent;
    $store = Store::find_by_sto001($id) ?: new Store;
    
    /*  該用戶city所有資料 */
    $city = Post::row($agent->age009) ?: new Post;

    /*  該用戶country */
    $country = $city->pos002 ?: 0;

    /*  該用戶city */
    $city = $city->pos001 ?: 0;


    $type = $pid ? 'R' : 'L';
    $title = empty($agent->age001) ? '新增' : '修改';
    $title .= Agent::getCorrespondTypes($type);

    $modify_readonly = empty($agent->age001) ? '' : 'readonly';
    
    $isHidden = $type == 'L' ? 'display:none;' : '';


    // $post = Post::allArray();

    $tpl->assign('bank', Bank::options());
    $tpl->assign('city', intval($city));
    $tpl->assign('country', $country);
    // $tpl->assign('post', $post);
    $tpl->assign('title', $title);
    $tpl->assign('isHidden', $isHidden);
    $tpl->assign('modify_readonly', $modify_readonly);
    $tpl->assign('pid', $pid);
    $tpl->assign('agent', $agent);
    $tpl->assign('store', $store);
	$tpl->display('page01_organize_modify.tpl');
