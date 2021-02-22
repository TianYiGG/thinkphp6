<?php

declare(strict_types=1);

namespace app\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        'name'  => 'require|max:20|checkName:天乙',
        'price' => 'number',
        'email' => 'email'
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];

    //自定义规则
    protected $rules = [
        'name' => 'require|max:20|checkName:天乙',
    ];
    protected function checkName($value, $rules)
    {
        return $rules = $value ? '名称存在非法称谓' : '';
    }
}
