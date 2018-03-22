<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('One');
            $content->description('服务器信息');

            $content->row(Dashboard::title());

            $content->row(function (Row $row) {

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
        });
    }
}
