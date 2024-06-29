<div class="row row-cards">
    {{-- Personal information --}}
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label required">Name</label>
                <div>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" aria-describedby="nameHelp" placeholder="e.g. First name Last name" value="@isset($userDetails){{$userDetails->name}}@endisset" required>
                    @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Father name</label>
                <div>
                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" aria-describedby="fathernameHelp" placeholder="e.g. First name Last name" value="@isset($userDetails){{$userDetails->profile->father_name}}@endisset" required>
                    @error('father_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Gender</label>
                <div>
                    <select name="gender" id="" class="form-select @error('gender') is-invalid @enderror" required>
                        <option value="male" @isset($userDetails){{($userDetails->profile->gender == 'male') ? 'selected' : ''}}@endisset>Male</option>
                        <option value="female" @isset($userDetails){{($userDetails->profile->gender == 'female') ? 'selected' : ''}}@endisset>Female</option>
                        <option value="third_gender" @isset($userDetails){{($userDetails->profile->gender == 'third_gender') ? 'selected' : ''}}@endisset>Third gender</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Date of birth</label>
                <div>
                    <input type="date" name="date_of_birth" id="" class="form-control" value="@isset($userDetails){{$userDetails->profile->date_of_birth->format('Y-m-d')}}@endisset">
                    @error('gender')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Martial Status</label>
                <div>
                    <select name="martial_status" id="" class="form-select @error('martial_status') is-invalid @enderror" required>
                        <option value="married" @isset($userDetails){{($userDetails->profile->martial_status == 'married') ? 'selected' : ''}}@endisset>Married</option>
                        <option value="unmarried" @isset($userDetails){{($userDetails->profile->martial_status == 'unmarried') ? 'selected' : ''}}@endisset>Unmarried</option>
                    </select>
                    @error('martial_status')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Hobby</label>
                <div>
                    <input type="text" class="form-control @error('hobby') is-invalid @enderror" name="hobby" aria-describedby="hobbyHelp" placeholder="e.g. Sports" required value="@isset($userDetails){{$userDetails->profile->hobby}}@endisset">
                    @error('hobby')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Related to sports</label>
                <div>
                    <input type="text" class="form-control @error('related_to_sports') is-invalid @enderror" name="related_to_sports" aria-describedby="related_to_sportsHelp" placeholder="e.g. Yes/No" required value="@isset($userDetails){{$userDetails->profile->related_to_sports}}@endisset">
                    <small class="form-hint">If yes then specify, otherwise type No.</small>
                    @error('related_to_sports')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Contact details --}}
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Contact Details</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label required">Address</label>
                <div>
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" aria-describedby="addressHelp" placeholder="Full address" required>@isset($userDetails){{$userDetails->contactDetails->address}}@endisset</textarea>
                    @error('address')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Primary contanct number</label>
                <div>
                    <input type="tel" name="primary_contact" class="form-control @error('primary_contact') is-invalid @enderror"  placeholder="" maxlength="10" autocomplete="off" required value="@isset($userDetails){{$userDetails->contactDetails->primary_contact}}@endisset">
                    @error('primary_contact')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Secondary contanct number</label>
                <div>
                    <input type="tel" name="secondary_contact" class="form-control @error('secondary_contact') is-invalid @enderror"  placeholder="" maxlength="10" autocomplete="off" value="@isset($userDetails){{$userDetails->contactDetails->secondary_contact}}@endisset">
                    @error('secondary_contact')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Whatsapp number</label>
                <div>
                    <input type="text" name="whatsapp_number" class="form-control @error('whatsapp_number') is-invalid @enderror"  placeholder="" maxlength="10" autocomplete="off" value="@isset($userDetails){{$userDetails->contactDetails->whatsapp_number}}@endisset">
                    @error('whatsapp_number')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Emergency contact</label>
                <div>
                    <input type="text" name="emergency_contact" class="form-control @error('emergency_contact') is-invalid @enderror"  placeholder="" maxlength="10" autocomplete="off" required value="@isset($userDetails){{$userDetails->contactDetails->emergency_contact}}@endisset">
                    @error('emergency_contact')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row row-cards">
    {{-- Qualification details --}}
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Qualification Details</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label required">Qualification</label>
                <div>
                    <input type="text" class="form-control @error('qualification') is-invalid @enderror" name="qualification" aria-describedby="qualificationHelp" placeholder="e.g. B.sc/B.Com/B.A" required value="@isset($userDetails){{$userDetails->qualifications->qualification}}@endisset">
                    @error('qualification')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Skills</label>
                <div>
                    <input type="text" class="form-control @error('skills') is-invalid @enderror" name="skills" aria-describedby="skillsHelp" placeholder="e.g. Tenting, Diving" required value="@isset($userDetails){{$userDetails->qualifications->skills}}@endisset">
                    @error('skills')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>
    {{-- Bank details --}}
    <div class="col-md-6">
        <div class="card-header">
            <h3 class="card-title">Bank Details</h3>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label required">Bank Name</label>
                <div>
                    <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" aria-describedby="bankNameHelp" placeholder="e.g. State Bank of India" required value="@isset($userDetails){{$userDetails->bankDetails->bank_name}}@endisset">
                    @error('bank_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Account number</label>
                <div>
                    <input type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" aria-describedby="accountNumberHelp" placeholder="e.g. 1234567890" required value="@isset($userDetails){{$userDetails->bankDetails->account_number}}@endisset">
                    @error('account_number')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">Account holder name</label>
                <div>
                    <input type="text" class="form-control @error('account_holder_name') is-invalid @enderror" name="account_holder_name" aria-describedby="accountHolderNameHelp" placeholder="e.g. First name Last name" required value="@isset($userDetails){{$userDetails->bankDetails->account_holder_name}}@endisset">
                    @error('account_holder_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label required">I.F.S.C code</label>
                <div>
                    <input type="number" class="form-control @error('ifsc_code') is-invalid @enderror" name="ifsc_code" aria-describedby="accountNumberHelp" placeholder="e.g. SBIN1234" required value="@isset($userDetails){{$userDetails->bankDetails->ifsc_code}}@endisset">
                    @error('ifsc_code')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row row-cards">
    {{-- Documents upload --}}
    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Documents upload</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label class="col-6 col-form-label required">
                            Aadhar/Identify proof
                            @isset($userDetails)<a href="{{asset('storage/'.$userDetails->documents->identity_proof)}}" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-external-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg></a>@endisset
                        </label>
                        <div class="col">
                            <input type="file" class="form-control @error('identity_proof') is-invalid @enderror" name="identity_proof" accept=".pdf" {{ (isset($userDetails)) ? '' : 'required' }}>
                            <small class="form-hint">Try with smaller size. Supported file type: .pdf</small>
                            @error('identity_proof')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-6 col-form-label required">
                            Photo
                            @isset($userDetails)<a href="{{asset('storage/'.$userDetails->documents->photo)}}" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-external-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg></a>@endisset
                        </label>
                        <div class="col">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" name="photo" accept=".png" {{ (isset($userDetails)) ? '' : 'required' }}>
                            <small class="form-hint">Try with smaller size. Supported file type: .png</small>
                            @error('photo')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3 row">
                        <label class="col-6 col-form-label required">
                            Signature
                            @isset($userDetails)<a href="{{asset('storage/'.$userDetails->documents->signature)}}" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-external-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg></a>@endisset
                        </label>
                        <div class="col">
                            <input type="file" class="form-control @error('signature') is-invalid @enderror" name="signature" accept="image/png" {{ (isset($userDetails)) ? '' : 'required' }}>
                            <small class="form-hint">Try with smaller size. Supported file type: .png</small>
                            @error('signature')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label class="col-6 col-form-label required">
                            Last qualification certificate
                            @isset($userDetails)<a href="{{asset('storage/'.$userDetails->documents->last_qualification)}}" target="_blank"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-external-link"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 6h-6a2 2 0 0 0 -2 2v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-6" /><path d="M11 13l9 -9" /><path d="M15 4h5v5" /></svg></a>@endisset
                        </label>
                        <div class="col">
                            <input type="file" class="form-control @error('last_qualification') is-invalid @enderror" name="last_qualification" accept=".pdf" {{ (isset($userDetails)) ? '' : 'required' }}>
                            <small class="form-hint">Try with smaller size. Supported file type: .pdf</small>
                            @error('last_qualification')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row row-cards">
    {{-- Official information --}}
    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Official information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label required">Email address</label>
                        <div>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" aria-describedby="emailHelp" placeholder="emailaddress@astaindia.org" required value="@isset($userDetails){{$userDetails->email}}@endisset">
                            <small class="form-hint">Must be enrolled in astaindia.org</small>
                            @error('email')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label required">@isset($userDetails)New @endisset Password</label>
                        <div>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" {{ (isset($userDetails)) ? '' : 'required' }}>
                            <small class="form-hint">
                                Your password must be 8-20 characters long, contain letters and numbers,
                                and must not contain
                                spaces, special characters, or emoji.
                            </small>
                            @error('password')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label required">Assign Role</label>
                        <div>
                            <select class="form-select @error('roles') is-invalid @enderror" name="roles[]" required>
                                @foreach($roles as $value)
                                    <option value="{{ $value }}" @isset($userDetails){{($value == $userDetails->roles[0]['name']) ? 'selected' : ''}}@endisset>{{ $value }}</option>
                                @endforeach
                            </select>
                            <small class="form-hint">
                                Based on that, the new user will get access privileges
                            </small>
                            @error('roles')<div class="invalid-feedback">{{$message}}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="card-footer text-end">
    <div class="d-flex">
        <a href="#" class="btn btn-link">Cancel</a>
        <button type="submit" class="btn btn-primary ms-auto">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" /><path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M14 4l0 4l-6 0l0 -4" /></svg>
            {{(isset($userDetails)) ? 'Update' : 'Save'}}
        </button>
    </div>
</div>
