<?php

namespace App\Admin\Controllers;

use App\User;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class UserController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('用户');
            $content->description('已注册用户详情');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('编辑');
            $content->description('编辑用户信息');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('新建');
            $content->description('新建用户');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(User::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('name','昵称');
            $grid->column('email','邮箱');
            $grid->column('is_active','邮箱验证')->display(function ($is_active){
                return $is_active ? "是" : "否" ;
            });
            $grid->column('questions_count','问题');
            $grid->column('answers_count','回答');
            $grid->column('comments_count','评论');
            $grid->column('favorites_count','收藏');
            $grid->column('likes_count','点赞');
            $grid->column('followers_count','被关注');
            $grid->column('followings_count','关注');
            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter){
                $filter->like('name','昵称');
                $filter->like('email','邮箱');
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(User::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','昵称');
            $form->email('email','邮箱');
            $form->display('is_active','邮箱验证')->with(function ($isActive){
                return $isActive ? '是' : '否';
            });
            $sex = [
                1 => '男',
                2 => '女',
                3 => '保密'
            ];
            $form->slider('profiles.age','年龄')->options(['max' => 100, 'min' => 10, 'step' => 1, 'postfix' => 'years old']);
            $form->select('profiles.sex','性别')->options($sex);
            $form->date('profiles.birthday','生日')->format('YYYY-MM-DD');
            $form->url('profiles.url','个人网站');
            $form->mobile('profiles.phone','手机号码')->options(['mask' => '999 9999 9999']);
            $form->display('questions_count','问题');
            $form->display('answers_count','回答');
            $form->display('comments_count','评论');
            $form->display('favorites_count','收藏');
            $form->display('likes_count','点赞');
            $form->display('followers_count','关注者');
            $form->display('followings_count','关注');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}