<div class="row">
    <div class="col-md-6">
        <label class="form-label">Role name</label>
        <input type="text" class="form-control" name="name" placeholder="e.g Employee / Admin" value="{{ isset($role) ? $role->name : '' }}">
    </div>
    <div class="col-md-6">
        <label for="" class="form-label">Permission sets</label>
        <div class="accordion" id="accordion-example">
            @foreach ($permissions as $key => $permission)
                <div class="accordion-item">
                    <h2 class="accordion-header" style="background-color: rgba(238, 237, 237, 0.712)" id="heading-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{$key}}" aria-expanded="false">
                            {{$key}}
                        </button>
                    </h2>
                    <div id="collapse-{{$key}}" class="accordion-collapse" data-bs-parent="#accordion-example">
                        <div class="accordion-body pt-0 mt-2">
                            <div class="col">
                                @foreach ($permission as $item)
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permission[]" value="{{$item['id']}}" @isset($assignedPermission){{ (in_array($item['id'], $assignedPermission)) ? 'checked' : '' }}@endisset>
                                        <span class="form-check-label">{{$item['name']}}</span>
                                    </label>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
