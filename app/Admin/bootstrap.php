<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use App\Admin\Extensions\ExpandRow;
use App\Admin\Extensions\WangEditor;
use Encore\Admin\Form;
use Encore\Admin\Grid\Column;

Encore\Admin\Form::forget(['map', 'editor']);
Admin::css('/admin-css/admin.css');
Admin::js('/vendor/chartjs/Chart.js');

Column::extend('expand', ExpandRow::class);
Form::extend('editor', WangEditor::class);
