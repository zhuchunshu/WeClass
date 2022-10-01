<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ClassfeeCycle;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ClassfeeCycleController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ClassfeeCycle(), function (Grid $grid) {
            $grid->export()->xlsx();
            $grid->filter(function($filter){
                // 展开过滤器
                //$filter->expand();

                $filter->like('date', '周期');
                $filter->like('reason', '原因');

            });
            $grid->column('id')->sortable()->display(function($id){
                return '<a href="./payer?cycle[id]='.$id.'">'.$id.'</a>';
            });
            $grid->column('date')->display(function($date){
                return '<a href="./payer?cycle[date]='.$date.'">'.$date.'</a>';
            });
            $grid->column('reason');
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
        return Show::make($id, new ClassfeeCycle(), function (Show $show) {
            $show->field('id');
            $show->field('date');
            $show->field('reason');
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
        return Form::make(new ClassfeeCycle(), function (Form $form) {
            $form->display('id');
            $form->datetime('date')->required();
            $form->text('reason')->required();
            $form->text('amount')->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
