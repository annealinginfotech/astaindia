<div class="form-row">
    <div class="form-group col-md-12">
        <label for="name">Name</label><code>*</code>
        <input type="text" id="name" name="name" value="@isset($user){{$user->name}}@endisset" placeholder="Full name" class="form-control @error('name') is-invalid @enderror" autocomplete="off" required/>
        @error('name')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="email">Email</label><code>*</code>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@isset($user){{$user->email}}@endisset" placeholder="john@example.com" autocomplete="off" required/>
        @error('email')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="password">Password</label>@unless(isset($user))<code>*</code>@endunless<small class="float-right">Min. 8 characters</small>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="" autocomplete="off" {{(isset($user)) ? '' : 'required'}}/>
        @error('password')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-12">
        <label for="password">Authorize to Create/Edit/Delete Bill</label><code>*</code>
        <select class="form-control" name="can_generate_bill">
            <option value="0" @isset($user){{($user->can_generate_bill == '0') ? 'selected' : ''}}@endisset>No</option>
            <option value="1" @isset($user){{($user->can_generate_bill == '1') ? 'selected' : ''}}@endisset>Yes</option>
        </select>
        @error('password')
            <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-row">
    <div class="col-md-12">
        <button type="reset" class="btn btn-danger">
            <i class="fa fa-refresh"></i> Reset
        </button>

        <button name="action" value="save" type="submit" class="btn btn-success float-right">
            <i class="fa fa-save"></i>
            @if (isset($user))
                Update
            @else
                Save
            @endif
        </button>
    </div>
</div>
