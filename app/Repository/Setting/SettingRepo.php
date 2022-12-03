<?php

namespace App\Repository\Setting;

use App\Models\Setting;

class SettingRepo implements ISettingRepo
{

    private Setting $setting;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    function find(int $id)
    {
        return $this->setting::find($id);
    }
}
