<?php
/**
 * 后台用户验证类
 * @author yupoxiong<i@yufuping.com>
 */

namespace app\admin\validate;

class AdminArticle extends Admin
{
    protected $rule = [
        'category_id|分类' => 'require',
        'title|标题'      => 'require',
        'content|内容'  => 'require',
    ];

    protected $message = [
        'email.email'  => '邮箱格式错误',
        'mobile.regex' => '手机格式错误',
    ];

    protected $scene = [
        'add'   => ['title', 'category_id', 'content'],
        'edit'  => ['title', 'category_id', 'content'],
    ];
}