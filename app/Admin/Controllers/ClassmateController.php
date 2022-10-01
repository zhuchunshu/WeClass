<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Classmate;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ClassmateController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Classmate(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('phone');
            $grid->column('sex');
            $grid->column('type');
            $grid->column('dormitory');
            $grid->column('remark');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
        
            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Classmate(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('phone');
            $show->field('sex');
            $show->field('type');
            $show->field('dormitory');
            $show->field('remark');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Classmate(), function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->text('phone');
            $form->text('sex');
            $form->text('type');
            $form->text('dormitory');
            $form->text('remark');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
