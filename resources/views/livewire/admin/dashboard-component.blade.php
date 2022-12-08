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
</div>
