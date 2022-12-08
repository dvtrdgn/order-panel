<div class="col-md-12">
    <div class="row">
        <div class="col-xl-12">
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dealers as $dealer)
                                <tr>
                                    <td>
                                        @if ($dealer->image)
                                            <div class="avatar avatar-lg"><img
                                                    src="{{ asset('assets/images/dealer') }}/{{ $dealer->image }}"
                                                    class="rounded" alt=""></div>
                                        @else
                                            <div class="avatar avatar-lg"><img
                                                    src="{{ asset('assets/images/static') }}/1660910188_user.png"
                                                    class="rounded avatar-image" alt=""></div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $dealer->name }}
                                    </td>
                                    <td>
                                        <x-element.link.info
                                            href="{{ route('admin.dealer.order-list', ['id' => $dealer->id]) }}">Order
                                            List</x-element.link.info>
                                    </td>
                                    <td>
                                        @if ($dealer->status == \App\Enums\Status::Active->value)
                                            <span class="badge badge-primary">
                                                {{ \App\Enums\Status::Active->name }}</span>
                                        @elseif ($dealer->status == \App\Enums\Status::Passive->value)
                                            <span class="badge badge-warning"> {{ \App\Enums\Status::Passive->name }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <x-element.link.primary
                                            href="{{ route('admin.dealer.edit', ['id' => $dealer->id]) }}">
                                            <x-element.icon.edit></x-element.icon.edit>
                                            </x-form.button>
                                            <x-element.link.danger type="button"
                                                wire:click="deleteId({{ $dealer->id }})" data-toggle="modal"
                                                data-target="#deleteModal">
                                                <x-element.icon.delete></x-element.icon.delete></i></x-form.button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3 float-right">
                    {{ $dealers->links() }}
                </div>
            </div>
        </div>
    </div>
    @if ($hasUser == 1)
        <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="deleteModalLabel">Alert !</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true close-btn">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>There are users associated with this dealer. </p>
                        <ul class="list-group">
                            @foreach ($getDealer->users as $user)
                                <li class="list-group-item ">{{ $user->name }} <a
                                        href="{{ route('admin.user.edit', ['id' => $user->id]) }}">
                                        <x-element.icon.edit></x-element.icon.edit>
                                        Edit
                                    </a></li>
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
