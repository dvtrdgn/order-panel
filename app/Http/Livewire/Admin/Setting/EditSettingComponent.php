<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;

class EditSettingComponent extends Component
{
    public Setting $setting;

    protected $rules = [
        'setting.name' => '',
        'setting.title' => '',
        'setting.author' => '',
        'setting.site_url' => '',
        'setting.copy' => '',
        'setting.keywords' => '',
        'setting.email1' => '',
        'setting.email2' => '',
        'setting.phone1' => '',
        'setting.phone2' => '',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount(Setting $setting)
    {
        $this->setting = $setting;
    }

    public function updateSetting()
    {
        $validatedData = $this->validate();
    }

    public function save()
    {
        $this->validate();

        if ($this->setting->isDirty()) {
            $this->setting->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Setting updated successfully!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => 'No new data to update!']
            );
        }
    }





    public function render()
    {
        return view('livewire.admin.setting.edit-setting-component');
    }
}
