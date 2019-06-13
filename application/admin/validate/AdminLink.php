<?php
/**
 * 后台用户验证类
 * @author yupoxiong<i@yufuping.com>
 */

namespace app\admin\validate;

class AdminArticleCategory extends Admin
{
    protected $rule = [
        'name|标题'      => 'require',
    ];

    protected $message = [
        'email.email'  => '邮箱格式错误',
        'mobile.regex' => '手机格式错误',
    ];

    protected $scene = [
        'add'   => ['name'],
        'edit'  => ['name'],
    ];
}