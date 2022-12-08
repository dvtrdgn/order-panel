<div class="col-md-12">
    <div class="col-xl-12">
        <fieldset class="form-fieldset mg-10 shadow-md hover:shadow-xl col-md-12">
            <legend>Waiting Order List</legend>
            <div class="card-header">
                <div class="col-md-12 row">
                    <div class="col-md-8">
                        <x-form.input type="text" class="form-control" placeholder="Search for..." wire:model="search">
                        </x-form.input>
                    </div>
                    <div class="col-md-4">
                        <x-form.select wire:model="dealerId" name="dealerId" :error="$errors->first('dealerId')" class="mb-3 w-full">
                            <option value="">Select Dealer</option>
                            @foreach ($dealers as $dealer)
                                <option value="{{ $dealer->id }}">{{ $dealer->name }}
                                    @if ($dealer->orders->where('isCompleted', 0)->where('isDealerCompleteOrder', 1)->count() > 0)
                                        | 1 order
                                    @endif
                                </option>
                            @endforeach
                        </x-form.select>
                    </div>
                </div>
                @if ($dealerId && $all_orders)
                    <x-form.button-secondary wire:click="PDFList">
                        <x-element.icon.download></x-element.icon.download> PDF Download
                    </x-form.button-secondary>
                    <x-form.button class="float-right" data-toggle="modal" data-target="#completeAllModal"> Complete All
                        Shown Order<x-element.icon.send></x-element.icon.send>
                    </x-form.button>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if ($all_orders)
                        <table class="table table-bordered border-top table-hover mb-0 text-nowrap">
                            <thead>
                                <tr>
                                    <th>Image </th>
                                    <th>Product </th>
                                    <th>Quantity</th>
                                    <th>Update Quantity</th>
                                    <th>Info</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_orders as $index => $order)
                                    @php
                                        $find_product = \App\Models\Product::where('id', $order['product_id'])->first();
                                        $find_order = \App\Models\Order::where('id', $order['id'])->first();
                                    @endphp
                                    @if ($find_product)
                                        <tr>
                                            <td>
                                                @if ($find_product->image)
                                                    <img src="{{ asset('assets/images/product') }}/{{ $find_product->image }}"
                                                        class="rounded h-14">
                                                @endif
                                            </td>
                                            <td><a
                                                    href="{{ route('admin.product.edit', ['id' => $find_product->id]) }}">
                                                    <h6 class="tx-secondary">{{ $find_product->title }}
                                                        <x-element.icon.detail></x-element.icon.detail>
                                                    </h6>
                                                </a>
                                                {{ $find_product->category->title }}
                                                @if ($find_product->quantity == 0 || $find_product->quantity == null)
                                                    <br> <span class="text-danger">
                                                        <a
                                                            href="{{ route('admin.product.edit', ['id' => $find_product->id]) }}">
                                                            <b>Check stock </b> </a>
                                                    </span>
                                                @endif
                                                <br>
                                                @if ($find_product->size)
                                                    <span class="text-primary"> Size :
                                                        {{ $find_product->size }}</span>
                                                @endif
                                            </td>
                                            <td style="max-width: 130px;"> <span
                                                    class=" tx-secondary font-weight-bold text-center"
                                                    style="font-size: 20px;">
                                                    {{ $order['quantity'] }}</span>
                                                <br>
                                                @if ($find_product->description_for_worker)
                                                    <span>
                                                        {{ $find_product->description_for_worker }}
                                                    </span>
                                                @endif
                                                @php
                                                    $checkStockCountForAllOrderById = \App\Models\Order::where('product_id', $order['product_id'])->sum('quantity');
                                                @endphp
                                                @if ($find_product->quantity >= 0)
                                                    <br>
                                                    @if ($checkStockCountForAllOrderById > $find_product->quantity)
                                                        <span class="text-danger">insufficient stock for all
                                                            order | {{ $checkStockCountForAllOrderById }}</span>
                                                    @endif
                                                    <p class="text-warning">Stock quantity :
                                                        <b>{{ $find_product->quantity }}</b>
                                                    </p>
                                                @endif
                                            </td>
                                            <td style="max-width: 130px;">
                                                <div class="input-group mb-3">
                                                    <input type='tel' style="border-color: #7987a1"
                                                        wire:model.defer="order_count.{{ $index }}"
                                                        wire:keydown.enter="saveOrder({{ $index }}, {{ $order['id'] }})"
                                                        type="number" placeholder="Quantity"
                                                        class="form-control @if ($selected_product == $index) @error('order_count')
                                                is-invalid
                                      @enderror @endif"
                                                        aria-describedby="button-addon2">
                                                    <div class="input-group-append">
                                                        <button style="font-size: 11px" wire:key
                                                            wire:click.prevent="saveOrder({{ $index }}, {{ $order['id'] }})"
                                                            class="btn btn-xs btn-outline-primary" type="button"
                                                            id="button-addon2">Change </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-primary small">
                                                    Ordered date :
                                                    {{ $find_order->created_at->format('y-m-d | H:i') }}</span>
                                                <br>
                                                <span class="badge badge-warning">
                                                    Ordered user : {{ $find_order->user->name }}</span> <br>
                                                <span class="badge badge-secondary">
                                                    Dealer : {{ $find_order->dealer->name }}</span>
                                                @php
                                                    $findOrdererdUser = \App\Models\User::where('id', $find_order->ordered_user_id)->first();
                                                @endphp
                                                @if ($findOrdererdUser)
                                                    <br>
                                                    <span class="badge badge-success">
                                                        Last updated : {{ $findOrdererdUser->name }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <x-form.button-success
                                                    wire:click="confirmCompleteOrder({{ $order['id'] }})"
                                                    data-toggle="modal" data-target="#completeModal">
                                                    <x-element.icon.ok></x-element.icon.ok> Complete
                                                </x-form.button-success>
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
                                    <h3>There is no order yet </h3>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </fieldset>
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
    <div wire:ignore.self class="modal fade" id="completeModal" tabindex="-1" role="dialog"
        aria-labelledby="completeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeModalLabel">Complete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to complete this order? </p>
                    @if ($completedOrder)
                        <p>Product: <b> {{ $completedOrder->product->title }}</b></p>
                        <p>Order Count: <b> {{ $completedOrder->quantity }}</b></p>
                    @endif
                </div>
                <div class="modal-footer">
                    <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>
                    <x-element.link.success type="button" wire:click.prevent="completeOrder()" data-dismiss="modal">
                        Yes, Complete</x-element.link.success>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="completeAllModal" tabindex="-1" role="dialog"
        aria-labelledby="completeAllModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="completeAllModalLabel">Complete Confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to complete all selected orders? </p>
                </div>
                <div class="modal-footer">
                    <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>
                    <x-element.link.success type="button" wire:click.prevent="allCompleteOrder()"
                        data-dismiss="modal">Yes, Complete</x-element.link.success>
                </div>
            </div>
        </div>
    </div>

</div>
