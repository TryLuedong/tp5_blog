<?php
/**
 * 后台用户验证类
 * @author yupoxiong<i@yufuping.com>
 */

namespace app\admin\validate;

class AdminLink extends Admin
{
    protected $rule = [
        'name|链接名'      => 'require',
        'url|链接'      => 'url',
    ];

    protected $message = [
        'email.email'  => '邮箱格式错误',
        'mobile.regex' => '手机格式错误',
    ];

    protected $scene = [
        'add'   => ['name','url'],
        'edit'  => ['name','url'],
    ];
}