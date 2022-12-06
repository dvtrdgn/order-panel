<?php

namespace App\Http\Livewire\Admin\Setting;

use App\Models\Setting;
use Livewire\Component;

class EditSettingComponent extends Component
{
    public Setting $setting;

    // validate form
    protected $rules = [
        'setting.name' => 'required| min:3',
        'setting.title' => 'required',
        'setting.author' => 'required',
        'setting.site_url' => 'required',
        'setting.copy' => '',
        'setting.keywords' => '',
        'setting.email1' => 'required|email',
        'setting.email2' => 'required|email',
        'setting.phone1' => 'required|min:6',
        'setting.phone2' => 'required|min:6',
        'setting.address1' => 'required',
        'setting.address2' => 'required',
    ];

    // customize validation message
    protected $messages = [
        'setting.email1' => 'Office email is required',
        'setting.email1.email' => 'Office email  must be a valid email address',
        'setting.email2.email' => 'Office email  must be a valid email address',
        'setting.email2' => 'Company email is required',
        'setting.address1' => 'Office address is required',
        'setting.address2' => 'Company address is required',
        'setting.phone1.required' => 'Office phone is required',
        'setting.phone1.min' => 'Office phone must be at least 6 characters.',
        'setting.phone2' => 'Company phone is required',
        'setting.phone1.min' => 'Company phone must be at least 6 characters.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function mount()
    {
        $this->setting = Setting::find(1);
    }

    public function updateSetting()
    {
        $validatedData = $this->validate();
    }

    // save setting form
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
