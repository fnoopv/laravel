<?php

namespace App\Admin\Controllers;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Question;
use App\User;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Table;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('One');
            $content->description('概览面板');

            $content->row(function (Row $row) {
                $row->column(12,'<h3 style="font-weight: 600;border-bottom: #8a6d3b 5px solid;">配置信息</h3>');
                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::environment());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::extensions());
                });

                $row->column(4, function (Column $column) {
                    $column->append(Dashboard::dependencies());
                });
            });

            $content->row(function (Row $row) {
                $row->column(12,'<h3 style="font-weight: 600;border-bottom: #8a6d3b 5px solid;">用户数据</h3>');
                $row->column(4, function (Column $column) {
                    $column->append(view('admin.charts.bar'));
                });
                $row->column(4, function (Column $column) {
                    $column->append(view('admin.charts.line'));
                });
                $row->column(4, function (Column $column) {
                    $column->append(view('admin.charts.pie'));
                });
            });

            $content->row(function (Row $row){
                $row->column(12,'<h3 style="font-weight: 600;border-bottom: #8a6d3b 5px solid;">问题数据</h3>');
                $row->column(4,function (Column $column){
                    $column->append(view('admin.charts.count'));
                });
            });
        });
    }
}
