<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repository\Setting\SettingRepo;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private SettingRepo $settingRepo;
    public function __construct(SettingRepo $settingRepo)
    {
        $this->settingRepo = $settingRepo;
    }

    public function edit()
    {
        return view('admin.setting.edit' , ['setting'=> $this->settingRepo->find(1)]);
    }
}
