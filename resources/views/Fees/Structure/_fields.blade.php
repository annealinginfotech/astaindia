<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label required">{{(!isset($feesDetails)) ? 'Select' : '' }} Base course</label>
        <select name="base_course_id" id="base_course" class="form-select @error('base_course_id') is-invalid @enderror" {{(!isset($feesDetails)) ? 'required' : '' }}>
            <option value="" selected disabled>{{(isset($feesDetails)) ? $feesDetails['base_course_name'] : '-- Choose Base course --' }}</option>
            @if (!isset($feesDetails))
                @foreach ($baseCourses as $baseCourse)
                    <option value="{{$baseCourse->id}}" @isset($mainCourse){{($feesDetailsam->base_course_id == $baseCourse->id) ? 'selected' : ''}}@endisset>{{$baseCourse->name}}</option>
                @endforeach
            @endif
        </select>
        @isset($feesDetails)<small class="text-danger">You can not edit the Base course.</small>@endisset
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

    <div class="col-md-4 mb-3" id="unit_section">
        <label class="form-label required">Unit</label>
        <select name="center_id" id="center_id" class="form-select @error('center_id') is-invalid @enderror" required>
            <option value="" selected disabled>-- Select unit --</option>
            @foreach ($units as $unit)
                <option value="{{$unit->id}}"
                    {{old('center_id', $feesDetails['center_id'] ?? '') == $unit->id ? 'selected' : ''}}>
                    {{$unit->name. ' ('.$unit->code.')'}}
                </option>
            @endforeach
        </select>
        {{-- <input type="text" class="form-control @error('parent_zone') is-invalid @enderror" name="parent_zone" placeholder="e.g Kolkata" value="{{old('parent_zone')}}"> --}}
        @error('center_id')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>

    <div class="col-md-3 mb-3">
        <label for="" class="form-label required">Age limit</label>
        <input type="text" name="age_limit" id="age_limit" class="form-control @error('age_limit') is-invalid @enderror" value="{{isset($feesDetails) ? $feesDetails['age_limit'] : ''}}">
        @error('age_limit') <div class="invalid-feedback">{{$message}}</div> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label required">Admission Fees</label>
        <input type="number" class="form-control @error('admission_fees') is-invalid @enderror" name="admission_fees" placeholder="e.g 100.00" step="0.01" value="{{ isset($feesDetails) ? $feesDetails['admission_fees'] : '' }}" required>
        @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label required">Monthly Fees</label>
        <input type="number" class="form-control @error('monthly_fees') is-invalid @enderror" name="monthly_fees" placeholder="e.g 100.00" step="0.01" value="{{ isset($feesDetails) ? $feesDetails['monthly_fees'] : '' }}" required>
        @error('monthly_fees')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label required">Exam Fees</label>
        <input type="number" class="form-control @error('exam_fees') is-invalid @enderror" name="exam_fees" placeholder="e.g 100.00" step="0.01" value="{{ isset($feesDetails) ? $feesDetails['exam_fees'] : '' }}" required>
        @error('exam_fees')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
