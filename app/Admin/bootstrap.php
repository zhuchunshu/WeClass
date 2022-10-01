<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Grid;
use Dcat\Admin\Form;
use Dcat\Admin\Grid\Filter;
use Dcat\Admin\Layout\Menu;
use Dcat\Admin\Show;

/**
 * Dcat-admin - admin builder based on Laravel.
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

Admin::menu(function (Menu $menu) {
    $menu->add([
        [
            'id'            => '1', // 此id只要保证当前的数组中是唯一的即可
            'title'         => '同学管理',
            'icon'          => 'feather icon-users',
            'uri'           => '/classmates',
            'parent_id'     => 0,
            'permission_id' => 'test', // 与权限绑定
            'roles'         => 'test-roles', // 与角色绑定
        ],
    ]);

    $menu->add([
        [
            'id'            => '1', // 此id只要保证当前的数组中是唯一的即可
            'title'         => '班费管理',
            'icon'          => 'feather icon-award',
            'uri'           => '/classfee',
            'parent_id'     => 0,
            'permission_id' => 'test', // 与权限绑定
            'roles'         => 'test-roles', // 与角色绑定
        ],
        [
            'id'            => '2', // 此id只要保证当前的数组中是唯一的即可
            'title'         => '账单管理',
            'icon'          => 'feather icon-award',
            'uri'           => '/classfee',
            'parent_id'     => 1,
            'permission_id' => 'test', // 与权限绑定
            'roles'         => 'test-roles', // 与角色绑定
        ],
        [
            'id'            => '3', // 此id只要保证当前的数组中是唯一的即可
            'title'         => '交费周期',
            'icon'          => '',
            'uri'           => '/classfee/cycle',
            'parent_id'     => 1 ,
            'permission_id' => 'test', // 与权限绑定
            'roles'         => 'test-roles', // 与角色绑定
        ],
        [
            'id'            => '4', // 此id只要保证当前的数组中是唯一的即可
            'title'         => '交费情况',
            'icon'          => '',
            'uri'           => '/classfee/payer',
            'parent_id'     => 1,
            'permission_id' => 'test', // 与权限绑定
            'roles'         => 'test-roles', // 与角色绑定
        ],
        [
            'id'            => '5', // 此id只要保证当前的数组中是唯一的即可
            'title'         => '退费处理',
            'icon'          => '',
            'uri'           => '/classfee',
            'parent_id'     => 1,
            'permission_id' => 'test', // 与权限绑定
            'roles'         => 'test-roles', // 与角色绑定
        ],
    ]);
});
