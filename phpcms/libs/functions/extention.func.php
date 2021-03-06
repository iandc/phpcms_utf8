<?php
/**
 *  extention.func.php 用户自定义函数库
 *
 * @copyright            (C) 2005-2010 PHPCMS
 * @license                http://www.phpcms.cn/license/
 * @lastmodify            2010-10-27
 */

function getNickName($userid = '', $field = '')
{
    $return = '';
    if (is_numeric($userid)) {
        $member_db = pc_base::load_model('member_model');
        $memberinfo = $member_db->get_one(array('userid' => $userid));
        if (!empty($field) && $field != 'nickname' && isset($memberinfo[$field]) && !empty($memberinfo[$field])) {
            $return = $memberinfo[$field];
        } else {
            $return = isset($memberinfo['nickname']) && !empty($memberinfo['nickname']) ? $memberinfo['nickname'] . '(' . $memberinfo['username'] . ')' : $memberinfo['username'];
        }
    } else {
        if (param::get_cookie('_nickname')) {
            $return .= param::get_cookie('_nickname');
        } else {
            $return .= param::get_cookie('_username');
        }
    }
    return $return;
}

function getNewsModelItemId($siteid = 1)
{
    $CATEGORYS = getcache('category_content_' . $siteid, 'commons');
    foreach ($CATEGORYS as $key => $value) {
        if ($value['siteid'] == $siteid && $value['modelid'] == 1 && $value['parentid'] == 0) {
            return $key;
        }
    }
    return 0;
}

function getCourseModelItemId($siteid = 1)
{
    $CATEGORYS = getcache('category_content_' . $siteid, 'commons');
    foreach ($CATEGORYS as $key => $value) {
        if ($value['siteid'] == $siteid && $value['modelid'] == 14 && $value['parentid'] == 0) {
            return $key;
        }
    }
    return 0;
}

function getAllTypeBySiteId($siteid = 1)
{
    $type_data = getcache('type_content_' . $siteid, 'commons');
    return $type_data;
}

function getTypeBySiteIdAndTypeId($typeid, $siteid = 1)
{
    $type_data = getAllTypeBySiteId($siteid);
    if (!$typeid) {
        return '';
    }
    foreach ($type_data as $key => $value) {
        if ($key == $typeid) {
            return $value['name'];
        }
    }
    return '';
}

function getCatNameByCatId($catid, $siteid = 1)
{
    $CATEGORYS = getcache('category_content_' . $siteid, 'commons');
    foreach ($CATEGORYS as $key => $value) {
        if ($key == $catid) {
            return $value['catname'];
        }
    }
    return '';
}


?>