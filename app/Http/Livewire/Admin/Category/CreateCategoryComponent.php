<?php

namespace App\Http\Livewire\Admin\Category;

use App\Enums\Status;
use App\Models\Category;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateCategoryComponent extends Component
{
    use WithFileUploads;
    public $title;
    public $image;
    public $order;
    public $status;
    public  $description;
    public $parent_id;
    public $allCategories;

    protected $rules = [
        'title' => 'required',
        'image' => 'max:2000'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->parent_id == null ? $this->parent_id = 0 : $this->parent_id;
        $this->validate();

        $category =  new Category();
        $category->parent_id = $this->parent_id;
        $category->title = $this->title;
        $category->status = $this->status;
        $category->order = $this->order;
        $category->description = $this->description;

        if ($this->image) {
            $image = Carbon::now()->timestamp . '_category.' . $this->image->extension();
            $this->image->storeAs('category', $image);
            $category->image = $image;
        }

        $result =  $category->save();

        $this->title = null;
        $this->image = null;
        $this->order = null;
        $this->description = null;
        $this->parent_id = null;
        $this->status = Status::Active->value;
        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'New category created successfully!']
            );
        }
    }

    public function mount()
    {
        $this->allCategories  = Category::with('children')->orderBy('parent_id', 'ASC')->get();
        $this->status = Status::Active->value;
    }

    public function render()
    {
        return view('livewire.admin.category.create-category-component');
    }
}
