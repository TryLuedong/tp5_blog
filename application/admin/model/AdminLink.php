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

class AdminLink extends Admin
{
//    use SoftDelete;

    protected $name = 'links';
    protected $autoWriteTimestamp = true;

    
}
