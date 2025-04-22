<div class="row">
    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Registration information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-2">
                    <label for="" class="form-label">Admission date</label>
                    <input type="date" name="registration_date" id="registration_date" class="form-control" min="{{date('d/m/Y')}}">
                </div>
                <div class="mb-3 col-md-2">
                    <label for="" class="form-label">State</label>
                    <select name="registration_state" id="registration_state" class="form-control">
                        <option value="" selected disabled>-- Choose state --</option>
                        @foreach ($states as $state)
                            <option value="{{$state->id}}">{{$state->state}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-2">
                    <label for="" class="form-label">District</label>
                    <select name="registration_district" id="registration_district" class="form-control">
                        <option value="" selected disabled>-- Choose district --</option>
                    </select>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="" class="form-label">Branch</label>
                    <select name="registration_branch" id="registration_branch" class="form-control">
                        <option value="" selected disabled>-- Choose branch --</option>
                    </select>
                </div>
                <div class="mb-3 col-md-3">
                    <label for="" class="form-label">Unit</label>
                    <select name="registration_unit" id="registration_unit" class="form-control">
                        <option value="" selected disabled>-- Choose unit --</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Select Base course</label>
                    <select name="base_course_id" id="base_course" class="form-select @error('base_course_id') is-invalid @enderror" required>
                        <option value="" selected disabled>-- Choose Base course --</option>
                        @foreach ($baseCourses as $baseCourse)
                            <option value="{{$baseCourse->id}}" @isset($mainCourse){{($mainCourse->base_course_id == $baseCourse->id) ? 'selected' : ''}}@endisset>{{$baseCourse->name}}</option>
                        @endforeach
                    </select>
                    @error('base_course_id')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label required">{{(!isset($feesDetails)) ? 'Select' : '' }} Main course <div class="spinner-border spinner-border-sm text-muted d-none" id="fetchingMainCourseLoader" role="status"></div></label>
                    <select name="main_course_id" id="main_course" class="form-select @error('main_course_id') is-invalid @enderror" {{(!isset($feesDetails)) ? 'required' : '' }}>
                        <option value="" selected disabled>{{(isset($feesDetails)) ? $feesDetails['main_course_name'] : '-- Choose Main course --' }}</option>
                    </select>
                    @isset($feesDetails)<small class="text-danger">You can not edit the Main course.</small>@endisset
                    @error('main_course_id')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label required">{{(!isset($feesDetails)) ? 'Select' : '' }} Fees structure <div class="spinner-border spinner-border-sm text-muted d-none" id="fetchingMainCourseLoader" role="status"></div></label>
                    <select name="main_course_id" id="main_course" class="form-select @error('main_course_id') is-invalid @enderror" {{(!isset($feesDetails)) ? 'required' : '' }}>
                        <option value="" selected disabled>{{(isset($feesDetails)) ? $feesDetails['main_course_name'] : '-- Choose Main course --' }}</option>
                    </select>
                    @isset($feesDetails)<small class="text-danger">You can not edit the Main course.</small>@endisset
                    @error('main_course_id')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Personal Information</h3>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label class="form-label required">First Name</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="" value="">
                    @error('first_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" placeholder="" value="">
                    @error('middle_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-4">
                    <label class="form-label required">Last Name</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="" value="">
                    @error('last_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Nick Name</label>
                    <input type="text" class="form-control @error('nick_name') is-invalid @enderror" name="nick_name" placeholder="" value="">
                    @error('nick_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="" selected disabled>-- Select gender --</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                    @error('gender')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Date of birth</label>
                    <input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob">
                    @error('dob')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Marital status</label>
                    <select name="marital_status" id="marital_status" class="form-control">
                        <option value="" selected disabled>-- Select marital status --</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="prefer_not_to_say">Prefer not to say</option>
                    </select>
                    @error('marital_status')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label required">Blood group</label>
                    <select name="blood_group" id="blood_group" class="form-control">
                        <option value="" selected disabled>-- Select blood group --</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                    @error('blood_group')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label required">Adhaar Number</label>
                    <input type="number" class="form-control @error('adhaar_no') is-invalid @enderror" name="adhaar_no" placeholder="" value="" maxlength="12">
                    @error('adhaar_no')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Guardian Information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-3">
                    <label class="form-label required">Father Name</label>
                    <input type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" placeholder="" value="">
                    @error('father_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label required">Mother Name</label>
                    <input type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" placeholder="" value="">
                    @error('mother_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label required">Guardian Name</label>
                    <input type="text" class="form-control @error('guardian_name') is-invalid @enderror" name="guardian_name" placeholder="" value="">
                    @error('guardian_name')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-3">
                    <label class="form-label required">Guardian relation</label>
                    <input type="text" class="form-control @error('guardian_relation') is-invalid @enderror" name="guardian_relation" placeholder="" value="">
                    @error('guardian_relation')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Present Address information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label class="form-label required">Present address</label>
                    <input type="text" class="form-control @error('present_address_line') is-invalid @enderror" name="present_address_line" placeholder="" value="">
                    @error('present_address_line')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Country</label>
                    <input type="text" class="form-control @error('present_country') is-invalid @enderror" name="present_country" placeholder="" value="">
                    @error('present_country')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">State</label>
                    <input type="text" class="form-control @error('present_state') is-invalid @enderror" name="present_state" placeholder="" value="">
                    @error('present_state')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">City / District</label>
                    <input type="text" class="form-control @error('present_city_district') is-invalid @enderror" name="present_city_district" placeholder="" value="">
                    @error('present_city_district')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Post office</label>
                    <input type="text" class="form-control @error('present_post_office') is-invalid @enderror" name="present_post_office" placeholder="" value="">
                    @error('present_post_office')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Police station</label>
                    <input type="text" class="form-control @error('present_police_station') is-invalid @enderror" name="present_police_station" placeholder="" value="">
                    @error('present_police_station')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Pincode</label>
                    <input type="text" class="form-control @error('present_pincode') is-invalid @enderror" name="present_pincode" placeholder="" value="">
                    @error('present_pincode')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Permanent Address information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-12">
                    <label class="form-label">Permanent address</label>
                    <input type="text" class="form-control @error('permanent_address_line') is-invalid @enderror" name="permanent_address_line" placeholder="" value="">
                    @error('permanent_address_line')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Country</label>
                    <input type="text" class="form-control @error('permanent_country') is-invalid @enderror" name="permanent_country" placeholder="" value="">
                    @error('permanent_country')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">State</label>
                    <input type="text" class="form-control @error('permanent_state') is-invalid @enderror" name="permanent_state" placeholder="" value="">
                    @error('permanent_state')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">City / District</label>
                    <input type="text" class="form-control @error('permanent_city_district') is-invalid @enderror" name="permanent_city_district" placeholder="" value="">
                    @error('permanent_city_district')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Post office</label>
                    <input type="text" class="form-control @error('permanent_post_office') is-invalid @enderror" name="permanent_post_office" placeholder="" value="">
                    @error('permanent_post_office')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Police station</label>
                    <input type="text" class="form-control @error('permanent_police_station') is-invalid @enderror" name="permanent_police_station" placeholder="" value="">
                    @error('permanent_police_station')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Pincode</label>
                    <input type="text" class="form-control @error('permanent_pincode') is-invalid @enderror" name="permanent_pincode" placeholder="" value="">
                    @error('permanent_pincode')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card-header">
            <h3 class="card-title">Contact information</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-2">
                    <label class="form-label">Student contact number</label>
                    <input type="tel" class="form-control @error('student_contact') is-invalid @enderror" name="student_contact" placeholder="" value="">
                    @error('student_contact')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Student alternate number</label>
                    <input type="tel" class="form-control @error('student_contact2') is-invalid @enderror" name="student_contact2" placeholder="" value="">
                    @error('student_contact2')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Student whatsapp number</label>
                    <input type="tel" class="form-control @error('student_whatsapp') is-invalid @enderror" name="student_whatsapp" placeholder="" value="">
                    @error('student_whatsapp')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Student email</label>
                    <input type="email" class="form-control @error('student_email') is-invalid @enderror" name="student_email" placeholder="" value="">
                    @error('student_email')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label required">Guardian contact</label>
                    <input type="text" class="form-control @error('guardian_contact') is-invalid @enderror" name="guardian_contact" placeholder="" value="">
                    @error('guardian_contact')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

                <div class="mb-3 col-md-2">
                    <label class="form-label">Guardian whatsapp</label>
                    <input type="text" class="form-control @error('guardian_whatsapp') is-invalid @enderror" name="guardian_whatsapp" placeholder="" value="">
                    @error('guardian_whatsapp')<div class="invalid-feedback">{{$message}}</div>@enderror
                </div>

            </div>
        </div>
    </div>
</div>
