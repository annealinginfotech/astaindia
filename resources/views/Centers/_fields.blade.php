<div class="row">
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Code</label>
                <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="e.g Kolkata" value="{{(isset($centerInformation)) ? $centerInformation->code : old('code')}}">
                @error('code')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="e.g Kolkata" value="{{(isset($centerInformation)) ? $centerInformation->name : old('name')}}">
                @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Type / Level</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                    <option value="" selected disabled>-- Select type --</option>
                    @foreach ($zones as $item)
                        {{-- <option value="{{$item->zone_type}}" {{(isset($centerInformation)) ? (($centerInformation->type == $item->zone_type) ? 'selected' : '') : ((old('type') == $item->zone_type) ? 'selected' : '')}}>{{$item->zone_name}}</option> --}}
                        <option value="{{ $item->zone_type }}"
                            {{ old('type', $centerInformation->type ?? '') == $item->zone_type ? 'selected' : '' }}>
                            {{ $item->zone_name }}
                        </option>
                    @endforeach
                </select>
                @error('type')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3" id="state_section">
                <label class="form-label">State</label>
                <select name="state_id" id="state_id" class="form-select @error('state_id') is-invalid @enderror">
                    <option value="" selected disabled>-- Select state --</option>
                    @foreach ($states as $state)
                        <option value="{{$state->id}}"
                            {{old('state_id', $centerInformation->state_id ?? '') == $state->id ? 'selected' : ''}}>
                            {{$state->state}}
                        </option>
                    @endforeach
                </select>
                {{-- <input type="text" class="form-control @error('parent_zone') is-invalid @enderror" name="parent_zone" placeholder="e.g Kolkata" value="{{old('parent_zone')}}"> --}}
                @error('state_id')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3" style="{{(isset($centerInformation)) ? 'display: block;' : 'display: none;'}}" id="parent_zone_section">
                <label class="form-label">Parent Zone</label>
                <select name="parent_zone" id="parent_zone" class="form-select @error('parent_zone') is-invalid @enderror">
                    <option value="" selected disabled>-- Select parent zone --</option>
                    @isset($centerInformation)
                        <option value="{{$centerInformation->controlCenter->parentZone->id}}" selected>{{$centerInformation->controlCenter->parentZone->name}}</option>
                    @endisset
                </select>
                {{-- <input type="text" class="form-control @error('parent_zone') is-invalid @enderror" name="parent_zone" placeholder="e.g Kolkata" value="{{old('parent_zone')}}"> --}}
                @error('parent_zone')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-select @error('status') is-invalid @enderror">
                    <option value="active" {{old('status', $centerInformation->status ?? '') == 'active' ? 'selected' : ''}}>Active</option>
                    <option value="inactive" {{old('status', $centerInformation->status ?? '') == 'inactive' ? 'selected' : ''}}>In active</option>
                </select>
            </div>

        </div>
    </div>

    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Contact information</h3>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Address</label>
                <textarea name="address" id="" cols="30" rows="9" class="form-control @error('address') is-invalid @enderror">{{old('address', $centerInformation->address ?? '')}}</textarea>
                @error('address')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="e.g Kolkata" value="{{old('email', $centerInformation->email ?? '')}}">
                @error('email')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="e.g Kolkata" value="{{old('phone', $centerInformation->phone ?? '')}}">
                @error('phone')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>
        </div>
    </div>
</div>
