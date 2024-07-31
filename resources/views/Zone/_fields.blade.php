<div class="row">
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" class="form-control @error('zone_name') is-invalid @enderror" name="zone_name" placeholder="e.g Kolkata" value="{{old('zone_name')}}">
                @error('zone_name')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Type / Level</label>
                <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                    <option value="" selected disabled>-- Select type --</option>
                    <option value="headquarters" {{ (old('type') == 'headquarters') ? 'selected' : ''}}>Head Quarters</option>
                    <option value="admin" {{ (old('type') == 'admin') ? 'selected' : ''}}>Admin</option>
                    <option value="state" {{ (old('type') == 'state') ? 'selected' : ''}}>State</option>
                    <option value="district" {{ (old('type') == 'district') ? 'selected' : ''}}>District</option>
                    <option value="branch" {{ (old('type') == 'branch') ? 'selected' : ''}}>Branch</option>
                    <option value="unit" {{ (old('type') == 'unit') ? 'selected' : ''}}>Unit</option>
                </select>
                @error('type')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3" style="display: none;" id="parent_zone_section">
                <label class="form-label">Parent Zone</label>
                <select name="parent_zone" id="parent_zone" class="form-select @error('parent_zone') is-invalid @enderror">
                    <option value="" selected disabled>-- Select parent zone --</option>
                </select>
                {{-- <input type="text" class="form-control @error('parent_zone') is-invalid @enderror" name="parent_zone" placeholder="e.g Kolkata" value="{{old('parent_zone')}}"> --}}
                @error('parent_zone')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-select @error('status') is-invalid @enderror">
                    <option value="active" {{(old('status') == 'active') ? 'selected' : ''}}>Active</option>
                    <option value="inactive" {{(old('status') == 'inactive') ? 'selected' : ''}}>In active</option>
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
                <textarea name="address" id="" cols="30" rows="9" class="form-control @error('address') is-invalid @enderror">{{old('address')}}</textarea>
                @error('address')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" placeholder="e.g Kolkata" value="{{old('phone_no')}}">
                @error('phone_no')<div class="invalid-feedback">{{$message}}</div>@enderror
            </div>
        </div>
    </div>
</div>
