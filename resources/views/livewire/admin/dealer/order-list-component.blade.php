<div class="col-md-12">
    <div class="row">
        <div class="col-xl-12">
            <div class="row my-2">
                <div class="col-md-5">
                    <x-form.input wire:change="query" wire:model="dateFrom" type="date" id="dateFrom"
                        class="form-control" :error="$errors->first('dateFrom')"></x-form.input>
                </div>
                <div class="col-md-5">
                    <x-form.input wire:change="query" wire:model="dateTo" type="date" id="dateTo"
                        class="form-control" :error="$errors->first('dateTo')"></x-form.input>
                </div>
                @if ($dateFrom || $dateTo)
                    <div class="col-md-2 ">
                     <label ></label>
                        <x-form.button-warning wire:click="clearDates" class="mb-3 w-full">Clear Filter</x-form.button-warning>
                    </div>
                @endif
            </div>
            <ul class="list-group">
                @foreach ($completedOrders as $orderlist)
                    @if ($orderlist->orders->count())
                        <li x-data="{ open: false }"
                            class="list-group-item alert alert-danger
                          {{ $orderlist->checkWaitingOrderList->count() > 0 ? 'uncompleted-order' : 'completed-order' }}"
                            style="margin-bottom: 5px; ">
                            <span class="text-secondary"> <b>{{ $orderlist->created_at->diffForHumans() }}</b>
                            </span> by
                            {{ $orderlist->user->dealer->name }} | <span class="text-secondary"><b>Order
                                    date</b></span>
                            : {{ $orderlist->created_at->format('y-m-d  H:i') }}
                            <div style="float: right " class="font-bold">
                                @if ($orderlist->checkWaitingOrderList->count())
                                    <span class="text-danger" style="margin-right: 20px !important;"> This order is
                                        not
                                        completed yet | Waiting product:
                                        {{ $orderlist->checkWaitingOrderList->count() }} </span>
                                @else
                                    <span class="text-success" style="margin-right: 20px !important;">This order
                                        list is
                                        completed</span>
                                @endif
                                <button x-on:click="open = ! open" class="btn btn-sm btn-outline-primary ">Show
                                    detail
                                    <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.75 17.25L12 21m0 0l-3.75-3.75M12 21V3" />
                                    </svg>
                                    <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8.25 6.75L12 3m0 0l3.75 3.75M12 3v18" />
                                    </svg>
                                </button>
                            </div>
                            <div x-cloak x-show="open" x-transition:enter.duration.500ms data-label="Order Detail"
                                class="table-responsive">
                                <table class="table table-bordered" style="margin-top: 20px;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Size</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderlist->orders as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $item->product->title }}</td>
                                                <td>{{ \App\Services\OrderService::getProductMainCategoryName($item->category_id) }}
                                                    | {{ $item->product->category->title }}</td>
                                                <td>{{ $item->product->size }}</td>
                                                <td>{{ $item->product->description_for_worker }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td class="font-bold">
                                                    @if ($item->isCompleted == 0)
                                                        <span class="text-danger"> Waiting admin
                                                            approval </span>
                                                    @else
                                                        <span class="text-primary">Admin approved at
                                                            {{ $item->updated_at->format('y-m-d  H:i') }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div style="float: right" class="mt-3">
                {{ $completedOrders->links() }}
            </div>
        </div>
    </div>
</div>
