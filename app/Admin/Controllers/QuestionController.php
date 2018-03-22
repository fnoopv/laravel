<?php

namespace App\Admin\Controllers;

use App\Question;

use App\User;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Encore\Admin\Widgets\Table;
use function foo\func;

class QuestionController extends Controller
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

            $content->header('问题');
            $content->description('已提问的问题');

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

            $content->header('问题');
            $content->description('问题详情');

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

            $content->header('添加');
            $content->description('添加问题');

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
        return Admin::grid(Question::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('title','标题')->editable();
            $grid->column('user_id','发起者')->display(function ($userId){
                return User::find($userId)->name;
            });
            $grid->column('comments_count','评论');
            $grid->column('followers_count','关注');
            $grid->column('answers_count','回答');
            $grid->column('close_comment','是否关闭')->display(function ($close_comment){
                if ($close_comment == "0")
                {
                    return "否";
                }
                return "是";
            });
            $grid->column('is_hidden','是否隐藏')->display(function ($is_hidden){
                if ($is_hidden == "0")
                {
                    return "否";
                }
                return "是";
            });
            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter){
                $filter->like('name','名字');
                $filter->equal('close_comment','关闭状态');
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
        return Admin::form(Question::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('title','标题');
            $form->editor('body','内容');
            $form->display('user_id','发起者ID');
            $form->display('comments_count','评论');
            $form->display('followers_count','关注');
            $form->display('answers_count','回答');
            $form->switch('close_comment','是否关闭')->states(function ($close){
                if ($close == "0")
                {
                    return ['off' => ['value' => 0, 'text' => '关闭', 'color' => 'danger']];
                }
                return ['on'  => ['value' => 1, 'text' => '打开', 'color' => 'success']];
            });

            $form->display('is_hidden','是否隐藏')->with(function ($isHidden){
                if ($isHidden==0)
                {
                    return "否";
                }
                return "是";
            });
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
