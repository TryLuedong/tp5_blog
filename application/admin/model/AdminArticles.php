<?php
/**
 * 后台管理员模型
 * @author yupoxiong<i@yufuping.com>
 */

namespace app\admin\model;

use traits\model\SoftDelete;

/**
 * @property mixed id
 * @property mixed name
 */

class AdminArticles extends Admin
{
//    use SoftDelete;

    protected $name = 'articles';
    protected $autoWriteTimestamp = true;

    
}
