<div class="col-md-12">
    {{-- <fieldset class="form-fieldset">
        <legend>User List</legend>
        <div class="form-group">
          <label class="d-block">Firstname</label>
          <input type="text" class="form-control" placeholder="Enter your firstname">
        </div>
        <div class="form-group">
          <label class="d-block">Lastname</label>
          <input type="text" class="form-control" placeholder="Enter your lastname">
        </div>
      </fieldset> --}}

    <div class="row">
        <div class="col-xl-12">
            <div data-label="Users " class="df-example">
                <div class="card-header">
                    <div class="input-group">
                        <div class="input-group ">
                            {{-- <input wire:change="$emitSelf('updatingSearch')" type="text" class="form-control"
                                placeholder="Search for..." wire:model="search"> --}}
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
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        @if ($user->profile_photo_path)
                                        <div class="avatar avatar-lg"><img src="{{ asset('assets/images/user') }}/{{ $user->profile_photo_path }}" class="rounded-circle" alt=""></div>
                                        @else
                                        <div class="avatar avatar-lg"><img src="{{ asset('assets/images/static') }}/1660910188_user.png" class="rounded-circle avatar-image" alt=""></div>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        @if ($user->role == \App\Enums\Role::Admin)
                                        {{ \App\Enums\Role::Admin->name }}
                                        @elseif ($user->role == \App\Enums\Role::User)
                                        {{ \App\Enums\Role::User->name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->status == \App\Enums\Status::Active->value)
                                        {{ \App\Enums\Status::Active->name }}
                                        @elseif ($user->status == \App\Enums\Status::Passive->value)
                                        {{ \App\Enums\Status::Passive->name }}
                                        @endif

                                    </td>
                                    <td>
                                        <x-element.link.primary href="{{ route('admin.user.edit', ['id' => $user->id]) }}">
                                            <x-element.icon.edit></x-element.icon.edit>
                                            </x-form.button>
                                            <x-element.link.danger type="button" wire:click="deleteId({{ $user->id }})" data-toggle="modal" data-target="#deleteModal">
                                                <x-element.icon.delete></x-element.icon.delete></i></x-form.button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="float: right" class="mt-3">
                        {{ $users->links() }}
                    </div>
                </div>

            </div>

        </div>
    </div>
    @if ($canDelete ==1)
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
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-footer">
                    <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>
                    <x-element.link.danger type="button" wire:click.prevent="delete()" data-dismiss="modal">Yes, Delete</x-element.link.danger>

               </div>
            </div>
        </div>
    </div>
    @else
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="deleteModalLabel">Alert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>This user has related with ordered product. You can not delete this user.</p>
                    <p>Instead of deleting this user, deactivate it.</p>
                </div>
                <div class="modal-footer">
                    <x-element.link.light type="button" data-dismiss="modal">Close</x-element.link.light>

                </div>
            </div>
        </div>
    </div>
    @endif
</div>
