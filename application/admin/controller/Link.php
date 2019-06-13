<?php

namespace app\admin\controller;

use app\admin\model\Admin;
use app\admin\model\AdminArticleCategory;
use app\admin\model\AdminLink;
use think\Db;
use think\Request;

class Link extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $model = new \app\admin\model\AdminLink();
        $page_param = ['query' => []];
//        if (isset($this->param['keywords']) && !empty($this->param['keywords'])) {
//            $page_param['query']['keywords'] = $this->param['keywords'];
//
//            $model->whereLike('name|nickname|email|mobile', "%" . $this->param['keywords'] . "%");
//            $this->assign('keywords', $this->param['keywords']);
//        }
//

        $list = $model
            ->paginate($this->webData['list_rows'], false, $page_param);
//

        $this->assign([
            'list' => $list,
            'page'  => $list->render(),
            'total' => $list->total()
        ]);
        return $this->fetch();
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function add()
    {
        if ($this->request->isPost()) {
            $result = $this->validate($this->param, 'AdminLink.add');
            if (true !== $result) {
                return $this->error($result);
            }
            try{
                $model = new AdminLink();
                $post                = input('post.');
                $data['name'] = $post['name'];
                $data['url'] = $post['url'];
                $data['add_time'] = time();
                $model->addData($data);
            }catch (\Exception $error){
                $this->exception($error);
            }
            $this->success();
        }

        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit()
    {
        $info = AdminLink::get($this->id);
        if ($this->request->isPost()) {
            $result_validate = $this->validate($this->param, 'AdminLink.edit');
            if (true !== $result_validate) {
                return $this->error($result_validate);
            }
            $model =  new AdminLink();
            $data['name'] = $this->param['name'];
            $data['url'] = $this->param['url'];
            $where['id'] = $this->id;
            $result = $model->save($data,$where);
            if ($result) {
                return $this->success();
            }
            return $this->error();
        }

        $this->assign([
            'info' => $info,
        ]);
        return $this->fetch('add');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    //删除
    public function del()
    {
        $id     = $this->id;
        $result = AdminArticleCategory::destroy(function ($query) use ($id) {
            $query->whereIn('id', $id);
        });
        if ($result) {
            return $this->deleteSuccess();
        }

        return $this->error('删除失败');
    }
}
