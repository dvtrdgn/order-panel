<div>
    <div class="col-md-12 col-xl-12 mg-t-10 mg-b-10 ">
        <div class="card ht-100p card-color card-border card-shadow">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0 ">All Dealer | <span class="text-secondary"> You have
                        {{ $dealers->count() }} dealers</span> </h6>
                <div class="d-flex align-items-center tx-18">
                    <a href="{{ route('admin.dealer.index') }}" class="link-03 lh-0" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-external-link">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="list-group list-group-flush tx-13 ">
                @foreach ($dealers as $dealer)
                    <li class="list-group-item d-flex pd-sm-x-20 card-color">
                        <div class="avatar">
                            @if ($dealer->image)
                                <img src="{{ asset('assets/images/dealer') }}/{{ $dealer->image }}" alt="img"
                                    class="rounded">
                            @else
                                <span
                                    class="avatar-initial rounded bg-gray-600">{{ mb_substr($dealer->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="pd-l-10">
                            <p class="tx-medium mg-b-0 font-bold" style="color: #0891b2">{{ strtoupper($dealer->name) }}
                            </p>
                            <small class="tx-12 tx-color-03 mg-b-0">
                                @if ($dealer->status == \App\Enums\Status::Active->value)
                                    <span class="badge badge-primary"> {{ \App\Enums\Status::Active->name }}</span>
                                @elseif ($dealer->status == \App\Enums\Status::Passive->value)
                                    <span class="badge badge-warning"> {{ \App\Enums\Status::Passive->name }} </span>
                                @endif
                                @if ($dealer->productsOnCart->count() > 0)
                                    | <span class="text-danger">waiting {{ $dealer->productsOnCart->count() }}
                                        product{{ $dealer->productsOnCart->count() > 1 ? 's' : '' }} on dealer
                                        cart</span>
                                @endif
                            </small>
                        </div>
                        <div class="mg-l-auto d-flex align-self-center">
                            <nav class="nav nav-icon-only"
                                style="margin-left: 20px; justify-content: flex-end !important;">
                                @if ($dealer->checkWaitingOrder->count())
                                    <x-element.link.secondary
                                        href="{{ route('admin.dealer.order-list', ['id' => $dealer->id]) }}"
                                        class="mx-2 my-1">{{ $dealer->checkWaitingOrder->count() }}
                                        product{{ $dealer->checkWaitingOrder->count() > 1 ? 's' : '' }} on
                                        waiting
                                        order list <x-element.icon.eye> </x-element.icon.eye>
                                    </x-element.link.secondary>
                                @endif
                                <x-element.link.success
                                    href="{{ route('admin.dealer.order-list', ['id' => $dealer->id]) }}"
                                    class="mx-2  my-1">All Orders <x-element.icon.arrow-circle>
                                    </x-element.icon.arrow-circle>
                                </x-element.link.success>
                                <x-element.link.light href="{{ route('admin.dealer.edit', ['id' => $dealer->id]) }}"
                                    class="mx-2  my-1">
                                    <x-element.icon.magnify></x-element.icon.magnify>
                                </x-element.link.light>
                            </nav>
                        </div>
                    </li>
                @endforeach
            </ul>
            <div class="card-footer text-center tx-13">
                <a href="{{ route('admin.dealer.index') }}" class="link-03 font-bold">View All Dealers Detail<i
                        class="icon ion-md-arrow-down mg-l-5"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-xl-12 d-sm-none d-md-block d-none d-sm-block" style="margin-top: 10px">
        <div class="card card-shadow">
            <div class="card-body ">
                <div class="row align-items-sm-end">
                    <div class="col-lg-12 col-xl-12">
                        <canvas id="allProductChart" height="380" width="600">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 mg-t-10">
        <div class="card card-shadow">
            @if ($allProductWithAlertStock->count() > 0)
                <div class="card-header pd-b-0 bd-b-0 pd-t-20 pd-lg-t-25 pd-l-20 pd-lg-l-25">
                    <h6 class="mg-b-5">Product Stock Status </h6>
                    <p class="tx-12 tx-color-03 mg-b-0">You should check the stock status of some products. Stock
                        quantities are less than the minimum quantity <a href="{{ route('admin.product.index') }}">
                            <b>Check
                                all product</b> </a></p>
                </div><!-- card-header -->
                <div class="card-body pd-sm-20 pd-lg-25">
                    <div class="table-responsive">
                        <table class="table table-dashboard mg-b-0">
                            <thead>
                                <tr>
                                    <th class="tx-normal">Product</th>
                                    <th class="text-right">Stock Quantity</th>
                                    <th class="text-right">Quantity for alert</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allProductWithAlertStock as $product)
                                    <tr>
                                        <td class="tx-medium tx-normal">
                                            <a href="{{ route('admin.product.edit', ['id' => $product->id]) }}">
                                                {{ $product->title }} <x-element.icon.arrow-circle>
                                                </x-element.icon.arrow-circle> </a>

                                        </td>
                                        <td class="tx-medium text-right tx-secondary">{{ $product->quantity }}
                                        </td>
                                        <td class="tx-medium text-right">{{ $product->alert_min_count }} <span
                                                class="mg-l-5 tx-10 tx-normal tx-danger"><i
                                                    class="icon ion-md-arrow-down"></i>
                                                {{ $product->alert_min_count - $product->quantity }} </span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="card-header pd-b-0 bd-b-0 pd-t-20 pd-lg-t-25 pd-l-20 pd-lg-l-25">
                    <h6 class="mg-b-5">Product Stock Status </h6>
                    <p class="tx-12 tx-color-03 mg-b-0">That's perfect, All products are in sufficient stock <a
                            href="{{ route('admin.product.index') }}">Check all product</a></p>
                    <br><br>
                </div>
            @endif
        </div>
    </div>


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endpush


    <script>
        document.addEventListener('livewire:load', function() {

            const labels = @this.AllProductName;
            const backgroundColor = [];
            const borderColor = [];
            for (let i = 0; i < labels.length; i++) {
                const r = Math.floor(Math.random() * 255);
                const g = Math.floor(Math.random() * 255);
                const b = Math.floor(Math.random() * 255);
                backgroundColor.push('rgba(' + r + ',' + g + ', ' + b + ', 0.2 )');
                borderColor.push('rgba(' + r + ',' + g + ', ' + b + ', 1 )');
            }
            const ctx11 = document.getElementById('allProductChart').getContext('2d');
            const myChart111 = new Chart(ctx11, {
                type: 'bar',
                data: {
                    labels: @this.AllProductName,
                    datasets: [{
                        label: 'All products with quantity less than 500',
                        data: @this.AllProductQuantity,
                        backgroundColor: backgroundColor,
                        borderColor: borderColor,
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                }
            });
        })
    </script>
</div>
