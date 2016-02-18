<?php

    include '../../conf/config.php';
    use model\Member;
    use model\Post;
    use model\Bank;

    $pid = Input::get('pid') ?: 0;
    $id = Input::get('id') ?: 0;

    $row = $id ? Member::find_by_mem001($id) : new Member;
    $member = $row->attributes();

    $member['mem007'] = $member['mem007']
        ? date_format($member['mem007'], 'Y-m-d')
        : null;

    $title = $id ? '修改會員' : '新增會員';

    $post = Post::allArray();

    /*  該用戶city所有資料 */
    $city = Post::find_by_pos001($member['mem008']) ?: new Post;

    /*  該用戶country */
    $country = $city->pos002 ?: 0;

    /*  該用戶city */
    $city = $city->pos001 ?: 0;


    $tpl->assign('bank', Bank::options());
    $tpl->assign('city', $city);
    $tpl->assign('country', $country);
    $tpl->assign('post', $post);
    $tpl->assign('title', $title);
    $tpl->assign('pid', $pid);
    $tpl->assign('id', $id);
    $tpl->assign('member', $member);
    $tpl->display('page11_organize_member_modify.tpl');

?>