<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditCategoryComponent extends Component
{
    use WithFileUploads;

    public $category_id;
    public $title;
    public $image;
    public $order;
    public $status;
    public $description;
    public $parent_id;
    public $allCategories;
    public $new_image;
    public $edited_category_id;

    protected $rules = [
        'title' => 'required',
        'new_image' => 'max:2000'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function getParentsTree($category, $title)
    {
        if ($category->parent_id == 0) {
            return $title;
        }
        $parent = Category::find($category->parent_id);
        $title = $parent->title . ' > ' . $title;
        return   $this->getParentsTree($parent, $title);
    }

    public function mount($edited_category_id)
    {
        $this->edited_category_id = $edited_category_id;

        $get_category = Category::where('id', $edited_category_id)->first();
        $this->category_id = $get_category->id;
        $this->title = $get_category->title;
        $this->order = $get_category->order;
        $this->status = $get_category->status;
        $this->description = $get_category->description;
        $this->parent_id = $get_category->parent_id;
        $this->image = $get_category->image;
        $this->allCategories  = Category::with('children')->orderBy('parent_id', 'ASC')->get();
    }


    public function save()
    {
        if ($this->parent_id == $this->category_id) {
            return $this->emit('alert', ['type' => 'warning', 'message' => __('You can not select this category as main category. Select other main catgeory.')]);
        }
        $this->validate();
        $updated_category =  Category::where('id', $this->category_id)->first();
        $updated_category->parent_id = $this->parent_id;
        $updated_category->title = $this->title;
        $updated_category->status = $this->status;
        $updated_category->order = $this->order;
        $updated_category->description = $this->description;

        if ($this->new_image) {
            $imagePath = "/category/" . $this->image;
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
            $imageName1 = Carbon::now()->timestamp . '_category.' . $this->new_image->extension();
            $this->new_image->storeAs('category', $imageName1);
            $updated_category->image = $imageName1;
            $this->image = $updated_category->image;
        }
        if ($updated_category->isDirty()) {
            $updated_category->save();
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Category updated successfully!']
            );
        } else {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'warning',  'message' => 'No data to change!']
            );
        }
    }
    public function render()
    {
        return view('livewire.admin.category.edit-category-component');
    }
}
