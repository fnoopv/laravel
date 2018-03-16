<?php

namespace App\Admin\Controllers;

use App\Topic;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class TopicController extends Controller
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

            $content->header('话题');
            $content->description('话题标签');

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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Topic::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->column('name','名称');
            $grid->column('bio','描述');
            $grid->column('questions_count','引用');
            $grid->column('followers_count','关注');
            $grid->created_at();
            $grid->updated_at();

            $grid->filter(function ($filter){
                $filter->like('name','名字');
                $filter->like('bio','描述');
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
        return Admin::form(Topic::class, function (Form $form) {

            $form->display('id', 'ID');
            $form->text('name','名称');
            $form->text('bio','描述');
            $form->number('questions_count','引用');
            $form->number('followers_count','关注');
            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}
