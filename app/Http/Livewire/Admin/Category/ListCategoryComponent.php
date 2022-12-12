<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategoryComponent extends Component
{
    use WithPagination;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $paginationTheme = 'bootstrap';
    public $search;
    public $categoryHasSubCategory;
    public $categoryHasProduct;
    public $get_related_category_with_parent_category;
    public $deleteId = null;


    public function deleteId($id)
    {
        $get_related_category_with_parent_category_count = Category::where('parent_id', $id)->count();
        $this->get_related_category_with_parent_category = Category::where('parent_id', $id)->get();
        $find_category = Category::find($id);
        $this->categoryHasProduct = 1;
        $this->categoryHasProduct =  $find_category->products->count();

        if ($get_related_category_with_parent_category_count > 0) {
            $this->categoryHasSubCategory = 1;
        } else {

            $this->categoryHasSubCategory = 0;
            $this->deleteId = $id;
            $this->get_deleted_item = Category::find($this->deleteId);
            $this->get_deleted_item = null;
        }
    }

    public function delete()
    {       
        $get_data = Category::find($this->deleteId);
        $imagePath = "/category/" . $get_data->image;
        if (Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $result =   Category::destroy($this->deleteId);
        if ($result) {
            $this->dispatchBrowserEvent(
                'alert',
                ['type' => 'success',  'message' => 'Category deleted!']
            );
        }
    }

    public function render()
    {
        return view('livewire.admin.category.list-category-component', ['categories' => Category::search($this->search)->with('children')->orderBy('title', 'ASC')->Paginate(Category::PAGINATION_COUNT)]);
    }
}
