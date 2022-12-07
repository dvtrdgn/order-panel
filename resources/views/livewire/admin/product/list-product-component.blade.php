<div class="row col-md-12">
    <div class="col-xl-12">
        <div class="col-xl-12">
            <div data-label="Products : {{ $productCount }}" class="df-example" style="padding: 25px 0px 25px 0px">
                <div class="card-header">
                    <div class="input-group">
                        <div class="input-group ">
                            <x-form.input wire:change="$emitSelf('updatingSearch')" type="text" class="form-control"
                                placeholder="Search for..." wire:model="search"></x-form.input>

                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered border-top table-hover mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th>Image </th>
                                    <th>Product </th>
                                    <th>Status </th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            @if ($product->image)
                                                <img src="{{ asset('assets/images/product') }}/{{ $product->image }}"
                                                    alt="img" class="h-12  imageList">
                                            @endif
                                        </td>
                                        <td>
                                            <title class="d-inline-block align-middle mb-0 ml-1 font-bold">
                                                {{ $product->title }} </title>
                                            @if ($product->quantity)
                                                <title
                                                    class="badge @if ($product->quantity > $product->alert_min_count) badge-success
                                            @else  badge-danger @endif  ">
                                                    Stock : {{ $product->quantity }}</title>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($product->status == \App\Enums\Status::Active->value)
                                                <span class="badge badge-primary">
                                                    {{ \App\Enums\Status::Active->name }}</span>
                                            @elseif ($product->status == \App\Enums\Status::Passive->value)
                                                <span class="badge badge-warning">
                                                    {{ \App\Enums\Status::Passive->name }} </span>
                                            @endif
                                        </td>
                                        <td>{{ \App\Models\Category::getParentsTree($product->category, $product->category->title) }}
                                        </td>
                                        <td>
                                            <x-element.link.primary
                                                href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                                <x-element.icon.edit></x-element.icon.edit>
                                                </x-form.button>
                                                <x-element.link.danger type="button"
                                                    wire:click="deleteId({{ $product->id }})"
                                                    class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                                    data-target="#deleteModal">
                                                    <x-element.icon.delete></x-element.icon.delete></i></x-form.button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div style="float: right" class="mt-3">
                {{ $products->links() }}
            </div>
        </div>
    </div>
    @if ($check_product_order_count > 0)
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Alert</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>This product has order, firstly you should delete all orders.</p>
                        <ul>
                            @foreach ($check_product_order as $item)
                                <li>{{ $item->product->title }}</li>
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
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                        <x-element.link.danger type="button" wire:click.prevent="delete()" data-dismiss="modal">Yes,
                            Delete</x-element.link.danger>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
