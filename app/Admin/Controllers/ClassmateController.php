<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Classmate;
use App\Excel\ClassmatesImport;
use App\Http\Controllers\Controller;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClassmateController extends Controller
{

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title="同学管理";

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected $description = [
        //        'index'  => 'Index',
        //        'show'   => 'Show',
        //        'edit'   => 'Edit',
        //        'create' => 'Create',
    ];

    /**
     * Set translation path.
     *
     * @var string
     */
    protected $translation;

    /**
     * Get content title.
     *
     * @return string
     */
    protected function title()
    {
        return $this->title ?: admin_trans_label();
    }

    /**
     * Get description for following 4 action pages.
     *
     * @return array
     */
    protected function description()
    {
        return $this->description;
    }

    /**
     * Get translation path.
     *
     * @return string
     */
    protected function translation()
    {
        return $this->translation;
    }

    /**
     * Index interface.
     *
     * @param  Content  $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['index'] ?? trans('admin.list'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param  mixed  $id
     * @param  Content  $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param  Content  $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['create'] ?? trans('admin.create'))
            ->body($this->form());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update($id)
    {
        return $this->form()->update($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return mixed
     */
    public function store()
    {
        return $this->form()->store();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Classmate(), function (Grid $grid) {
            $grid->export()->xlsx();
            $grid->filter(function($filter){
                // 展开过滤器
                //$filter->expand();

                $filter->like('name', '姓名');

            });
            $grid->tools('<a href="./classmates/import" class="btn btn-primary">导入数据</a>');
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('phone');
            $grid->column('sex');
            $grid->column('type');
            $grid->column('job');
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
            $show->field('job');
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
            $form->text('name')->required()->rules(function (Form $form) {

                // 如果不是编辑状态，则添加字段唯一验证
                if (!$id = $form->model()->id) {
                    return 'unique:classmates,name';
                }

            });
            $form->text('phone')->required();
            $form->select('sex')->options(['男'=>'男','女' => '女'])->required();
            $form->select('type')->options(['老同学'=>'老同学','转专业' => '转专业','新到校' => '新到校','换班' => '换班'])->required();
            $form->text('job')->required();
            $form->text('dormitory');
            $form->textarea('remark');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }

    // 导入视图
    public function import(Content $content){
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description('导入数据')
            ->body($this->import_form());
    }

    // 处理导入

    public function onImport(Request $request,Form $form){
        $path = public_path('uploads/'.$request->get('file'));
        $array = Excel::toarray(new ClassmatesImport(), $path);
        $array = $array[0];
        $rows = [];
        foreach ($array as $key => $value){
            if($key>=4 && $value[0]){
                $data = [
                    'name' => $value[1],
                    'sex' => $value[2],
                    'phone' => $value[3],
                    'type' => $value[4],
                    'remark' => $value[5]
                ];
                $rows[] = $data;
            }
        }
        foreach($rows as $value){
            if(!\App\Models\Classmate::query()->where('name',$value['name'])->exists()){
                \App\Models\Classmate::query()->create($value);
            }
        }
        return $form->response()->success('导入成功!')->redirect('classmates');
    }

    // 表单
    protected function import_form()
    {
        return Form::make(null, function (Form $form) {
            $form->action('classmates/import');
            $form->disableResetButton();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
            $form->disableEditingCheck();
            $form->file('file','同学数据')->disk('admin')->url('upload')->autoUpload();
        });
    }

}
