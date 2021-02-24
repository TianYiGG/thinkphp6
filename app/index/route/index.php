<?php

use think\facade\Route;

Route::rule('vr/:id', 'Verify/route')->validate(User::class, 'route');
