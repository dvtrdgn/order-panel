<div class="col-md-12">
    <div class="row">
        <div class="col-xl-12">
            <div class="card-header">
                <div class="input-group">
                    <div class="input-group ">
                        <x-form.input wire:change="$emitSelf('updatingSearch')" type="text" class="form-control" placeholder="Search for..." wire:model="search"></x-form.input>
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
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dealers as $dealer)
                            <tr>
                                <td>
                                    @if ($dealer->image)
                                    <div class="avatar avatar-lg"><img src="{{ asset('assets/images/dealer') }}/{{ $dealer->image }}" class="rounded" alt=""></div>
                                    @else
                                    <div class="avatar avatar-lg"><img src="{{ asset('assets/images/static') }}/1660910188_user.png" class="rounded avatar-image" alt=""></div>
                                    @endif
                                </td>
                                <td>
                                    {{ $dealer->name }}
                                </td>
                                <td>
                                    {{ $dealer->email }}
                                </td>
                                <td>
                                    @if ($dealer->status == \App\Enums\Status::Active->value)
                                    <span class="badge badge-primary"> {{ \App\Enums\Status::Active->name }}</span>
                                    @elseif ($dealer->status == \App\Enums\Status::Passive->value)
                                    <span class="badge badge-warning"> {{ \App\Enums\Status::Passive->name }} </span>
                                    @endif
                                </td>
                                <td>
                                    <x-element.link.primary href="{{ route('admin.dealer.edit', ['id' => $dealer->id]) }}">
                                        <x-element.icon.edit></x-element.icon.edit>
                                        </x-form.button>
                                        <x-element.link.danger type="button" wire:click="deleteId({{ $dealer->id }})" data-toggle="modal" data-target="#deleteModal">
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
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                        <li class="list-group-item">{{ $user->name }} <a href="{{ route('admin.user.edit', ['id' => $user->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                    </path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg> Edit</a></li>
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
