<?php
/**
 * 后台模型父类
 * @author yupoxiong<i@yufuping.com>
 * Date: 2018/5/20
 */

namespace app\admin\model;

use app\common\model\Model;

class Admin extends Model
{
    //新增
    public function addData($data = []) {
        $id = $this->insertGetId($data);
        return empty($id) ? exception('写入失败') : $id;
    }

    //新增多条
    public function addAllData($data = []) {
        $data   = array_values($data);
        $result = $this->insertAll($data);
        return empty($result) ? exception('写入失败') : true;
    }

    //保存
    public function saveData($options = [], $data) {
        if (is_numeric($options)) {
            $pk             = $this->getPk();
            $condition      = [];
            $condition[$pk] = $options;
        } else {
            $condition = $options;
        }
        if (empty($condition)) {
            exception('更新条件不能为空');
        }
        $result = $this->where($condition)->update($data);
        return false === $result ? exception('更新失败') : true;
    }

    //删除
    public function deleteData($options = [], $real_deleted = true) {
        if (is_numeric($options)) {
            $pk             = $this->getPk();
            $condition      = [];
            $condition[$pk] = $options;
        } else {
            $condition = $options;
        }
        //真删除情况
        if ($real_deleted) {
            $result = $this->where($condition)->delete();
        } else {
            $data["is_deleted"] = 1;
            $result             = $this->where($condition)->update($data);
        }

        return false === $result ? exception('删除失败') : true;
    }

    //详情
    public function getInfo($options = []) {
        if (is_numeric($options)) {
            $pk             = $this->getPk();
            $condition      = [];
            $condition[$pk] = $options;
        } else {
            $condition = $options;
        }
        $result = $this->where($condition)->find();
        return empty($result) ? [] : $result->toArray();
    }

    ////列表
    public function getList($options = array()) {
        return $this->where($options)->select();
    }

}