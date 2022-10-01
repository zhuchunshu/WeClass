<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ClassfeePayer;
use App\Models\ClassfeeCycle;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ClassfeePayerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(ClassfeePayer::with('cycle'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->filter(function($filter){
                // 展开过滤器
                //$filter->expand();

                $filter->like('cycle.date', '周期');
                $filter->like('cycle.id', '周期ID');
                $filter->like('reason', '原因');

            });
            $grid->column('cycle.date','交费周期')->sortable();
            $grid->column('name');
            $grid->column('image')->image('','50','120');
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
        return Show::make($id, ClassfeePayer::with('cycle'), function (Show $show) {
            $show->field('id');
            $show->field('cycle.date','交费周期');
            $show->field('name');
            $show->field('image')->image();
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
        return Form::make(new ClassfeePayer(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->image('image')->disk('admin')->url('upload')->autoUpload();
            $form->textarea('remark');
            $cycles = [];
            foreach(ClassfeeCycle::query()->orderBy('id','desc')->get() as $value){
                $cycles[$value->id] = $value->date;
            }
            $form->select('cycle_id','交费周期')->options($cycles)->required();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
