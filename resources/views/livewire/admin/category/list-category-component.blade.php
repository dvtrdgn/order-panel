    <div class="row col-md-12">
        <div class="col-xl-12">
            <div class="card-header">
                <div class="input-group">
                    <div class="input-group ">
                        <x-form.input wire:change="$emitSelf('updatingSearch')" type="text" class="form-control" placeholder="Search for..." wire:model="search"></x-form.input>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered border-top table-hover mb-0 text-nowrap">
                        <thead>
                            <tr>
                                <th>Parent Category</th>
                                <th>Category </th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $this->getParentsTree($category, $category->title) }}</td>
                                <td>
                                    @if (!$category->image == null)
                                    <img src="{{ asset('assets/images/category') }}/{{ $category->image }}" alt="img" class="h-12  mb-3"> 
                                    @endif
                                    <p class="d-inline-block align-middle mb-0 ml-1">
                                        <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{ $category->title }}</a>
                                        <br>
                                    </p>
                                </td>
                                <td>
                                    @if ($category->status == \App\Enums\Status::Active->value)
                                   <span class="badge badge-primary"> {{ \App\Enums\Status::Active->name }}</span>
                                    @elseif ($category->status == \App\Enums\Status::Passive->value)
                                    <span class="badge badge-warning">  {{ \App\Enums\Status::Passive->name }} </span>
                                    @endif
                                </td>
                                <td>
                                    <x-element.link.primary href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
                                        <x-element.icon.edit></x-element.icon.edit>
                                        </x-form.button>
                                        <x-element.link.danger type="button" wire:click="deleteId({{ $category->id }})" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deleteModal">
                                            <x-element.icon.delete></x-element.icon.delete></i></x-form.button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 float-right">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        @if ($categoryHasProduct > 0 || $categoryHasSubCategory == 1)
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Alert !</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul>
                            @if ($categoryHasProduct > 0)
                            <li>
                                <p class="text-danger">This category has {{ $categoryHasProduct }} related
                                    product(s)</p>
                            </li>
                            @endif
                            @if ($categoryHasSubCategory == 1)
                            <li>
                                <p class="text-danger">This category has subcategory. Firstly, you should delete
                                    subcategories </p>
                            </li>
                            @endif
                        </ul>
                        <ul class="list-group">
                            @foreach ($get_related_category_with_parent_category as $category)
                            <li class="list-group-item">{{ $category->title }} <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}"> Edit</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Confirm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure want to delete? </p>
                    </div>
                    <div class="modal-footer">
                        <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>
                        <x-element.link.danger type="button" wire:click.prevent="delete()" data-dismiss="modal">Yes, Delete</x-element.link.danger>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
