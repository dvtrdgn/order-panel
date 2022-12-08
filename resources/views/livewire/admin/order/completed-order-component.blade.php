<div class="col-md-12">
    <fieldset class="form-fieldset mg-10 shadow-md hover:shadow-xl col-md-12">
        <legend>Completed Order List</legend>
        <div class="col-xl-12">
            <div data-label="Completed Order List " class="df-example" style="padding: 25px 0px 25px 0px">
                <div class="card-header">
                    <div class="col-md-12 row">
                        <div class="col-md-8">
                            <x-form.input wire:change="$emitSelf('updatingSearch')" type="text" class="form-control"
                                placeholder="Search with product name" wire:model="search">
                            </x-form.input>
                        </div>
                        <div class="col-md-4">
                            <x-form.select wire:model="dealerId" name="dealerId" :error="$errors->first('dealerId')" class="mb-3 w-full">
                                <option value="">Select Dealer</option>
                                @foreach ($dealers as $dealer)
                                    <option value="{{ $dealer->id }}">{{ $dealer->name }}
                                        @if ($dealer->orders->where('isCompleted', 1)->where('isDealerCompleteOrder', 1)->count() > 0)
                                            | 1 order
                                        @endif
                                    </option>
                                @endforeach
                            </x-form.select>
                        </div>
                    </div>
                </div>
                <div class="card-body bg-slate-200">
                    <div class="table-responsive">
                        @if (!$completedOrders->isEmpty())
                            <table class="table table-bordered border-top table-hover mb-0 text-nowrap ">
                                <thead>
                                    <tr>
                                        <th>Ordered Date </th>
                                        <th>Image </th>
                                        <th>Product </th>
                                        <th>Quantity</th>
                                        <th>Info</th>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($completedOrders as $order)
                                        @php
                                            $product = \App\Models\Product::where('id', $order->product_id)->first();
                                        @endphp
                                        @if ($product)
                                            <tr>
                                                <td>
                                                    {{ $order->created_at->format('Y-m-d H:i') }}
                                                </td>
                                                <td>
                                                    @if ($product->image)
                                                        <img src="{{ asset('assets/images/product') }}/{{ $product->image }}"
                                                            class="rounded h-14">
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="d-inline-block align-middle mb-0 ml-1">
                                                        <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}"
                                                            class="d-inline-block align-middle mb-0 product-name font-weight-semibold">{{ $product->title }}</a>
                                                    </p>
                                                    <br>
                                                    {{ \App\Models\Category::getParentsTree($product->category, $product->category->title) }}
                                                </td>
                                                <td>
                                                    <b>{{ $order->quantity }}</b>
                                                </td>
                                                <td>
                                                    <span class="badge badge-warning">
                                                        Ordered user : {{ $order->user->name }}</span> <br>
                                                    <span class="badge badge-secondary">
                                                        Dealer : {{ $order->dealer->name }}</span>
                                                    @php
                                                        $findOrdererdUser = \App\Models\User::where('id', $order->ordered_user_id)->first();
                                                    @endphp
                                                    @if ($findOrdererdUser)
                                                        <br> <span class="badge badge-success">Approved :
                                                            {{ $findOrdererdUser->name }} </span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <x-form.button-warning
                                                        wire:click="confirmRetrieveOrder({{ $order->id }})"
                                                        data-toggle="modal" data-target="#retrieveOrder">
                                                        <x-element.icon.back></x-element.icon.back> Retrive order
                                                    </x-form.button-warning>

                                                    <x-form.button-danger
                                                        wire:click.prevent="confirmDelete({{ $order['id'] }})"
                                                        data-toggle="modal" data-target="#deleteModal">
                                                        <x-element.icon.delete></x-element.icon.delete>
                                                    </x-form.button-danger>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="card-header">
                                <div class="input-group">
                                    <div style="margin: auto;width: 50%; padding: 10px;">
                                        <h3>There is no completed order yet </h3>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div style="float: right" class="mt-3">
                {{ $completedOrders->links() }}
            </div>
        </div>
    </fieldset>
    <div wire:ignore.self class="modal fade" id="retrieveOrder" tabindex="-1" role="dialog"
        aria-labelledby="retrieveOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="retrieveOrderModalLabel">Retrieve Order Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to retrieve order to waiting order list ? </p>
                    @if ($retrieveOrder)
                        <p class="text-danger">{{ $retrieveOrder->product->title }}</p>

                        <p>
                            Not: The order quantity ( <span class="text-danger"> {{ $retrieveOrder->quantity }}</span>
                            ) will be added back to the product stock quantity.
                        </p>
                    @endif
                </div>
                <div class="modal-footer">
                    <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>
                    <x-element.link.warning type="button" wire:click.prevent="retrieveOrder()" data-dismiss="modal">
                        Yes,
                        Set as waiting product</x-element.link.warning>
                </div>
            </div>
        </div>
    </div>
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
                    <x-element.link.danger type="button" wire:click.prevent="cancelOrder()" data-dismiss="modal">Yes,
                        Delete</x-element.link.danger>
                </div>
            </div>
        </div>
    </div>
</div>
