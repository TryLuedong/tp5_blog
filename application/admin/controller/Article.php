<?php

namespace app\admin\controller;

use app\admin\model\AdminArticleCategory;
use app\admin\model\AdminArticles;
use app\admin\validate\Admin;
use app\admin\validate\AdminArticle;
use think\Controller;
use think\Db;
use think\Request;

class Article extends Base
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $model = new AdminArticles();
        $page_param = ['query' => []];
//        if (isset($this->param['keywords']) && !empty($this->param['keywords'])) {
//            $page_param['query']['keywords'] = $this->param['keywords'];
//
//            $model->whereLike('name|nickname|email|mobile', "%" . $this->param['keywords'] . "%");
//            $this->assign('keywords', $this->param['keywords']);
//        }
//

//        $list = $model
//            ->relation('adminCategory')
//            ->paginate($this->webData['list_rows'], false, $page_param);
//
        $list =  Db::name('articles')
            ->alias('a')
            ->join('bear_article_category b','b.id= a.category_id','LEFT')
            ->field('a.*,b.category_name')
            ->paginate($this->webData['list_rows'], false, $page_param);
        $this->assign([
            'list' => $list,
            'page' => $list->render(),
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
            $result = $this->validate($this->param, 'AdminArticle.add');
            if (true !== $result) {
                return $this->error($result);
            }
            $post = input('post.');

            $model = new AdminArticles();
            $data['category_id'] = $post['category_id'];
            $data['title'] = $post['title'];
            $data['content'] = $post['content'];
            $data['add_time'] = time();
            //添加用户
            $model->addData($data);

            $this->success();
        }
        //获取图书类别
        $categoty = new AdminArticleCategory();
        $category_list = $categoty->getList();
        $this->assign('category_list', $category_list);
        $this->assign('type', 1);
        return $this->fetch();
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int $id
     * @return \think\Response
     */
    public function edit()
    {
        $info = AdminArticles::get($this->id);
        if ($this->request->isPost()) {
            $result_validate = $this->validate($this->param, 'AdminArticle.edit');
            if (true !== $result_validate) {
                return $this->error($result_validate);
            }
            $model =  new AdminArticles();
            $data['category_id'] = $this->param['category_id'];
            $data['title'] = $this->param['title'];
            $data['content'] = $this->param['content'];
            $where['id'] = $this->id;
            $result = $model->save($data,$where);
            if ($result) {
                return $this->success();
            }
            return $this->error();
        }
        $categoty = new AdminArticleCategory();
        $category_list = $categoty->getList();
        $this->assign([
            'info' => $info,
            'category_list' => $category_list,
            'type' => 2,
        ]);
        return $this->fetch('add');
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request $request
     * @param  int $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
