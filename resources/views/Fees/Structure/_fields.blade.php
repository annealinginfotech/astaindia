<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label required">{{(!isset($feesDetails)) ? 'Select' : '' }} Base course</label>
        <select name="base_course_id" id="base_course" class="form-select @error('base_course_id') is-invalid @enderror" {{(!isset($feesDetails)) ? 'required' : '' }}>
            <option value="" selected disabled>{{(isset($feesDetails)) ? $feesDetails['base_course_name'] : '-- Choose Base course --' }}</option>
            @if (!isset($feesDetails))
                @foreach ($baseCourses as $baseCourse)
                    <option value="{{$baseCourse->id}}" @isset($mainCourse){{($feesDetailsam->base_course_id == $baseCourse->id) ? 'selected' : ''}}@endisset>{{$baseCourse->name}}</option>
                @endforeach
            @endif
        </select>
        @isset($feesDetails)<small class="form-hint">You can not edit the Base course.</small>@endisset
        @error('base_course_id')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label required">{{(!isset($feesDetails)) ? 'Select' : '' }} Main course <div class="spinner-border spinner-border-sm text-muted d-none" id="fetchingMainCourseLoader" role="status"></div></label>
        <select name="main_course_id" id="main_course" class="form-select @error('main_course_id') is-invalid @enderror" {{(!isset($feesDetails)) ? 'required' : '' }}>
            <option value="" selected disabled>{{(isset($feesDetails)) ? $feesDetails['main_course_name'] : '-- Choose Main course --' }}</option>
        </select>
        @isset($feesDetails)<small class="form-hint">You can not edit the Main course.</small>@endisset
        @error('main_course_id')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label required">Admission Fees</label>
        <input type="number" class="form-control @error('admission_fees') is-invalid @enderror" name="admission_fees" placeholder="e.g 100.00" step="0.01" value="{{ isset($feesDetails) ? $feesDetails['admission_fees'] : '' }}" required>
        @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label required">Monthly Fees</label>
        <input type="number" class="form-control @error('monthly_fees') is-invalid @enderror" name="monthly_fees" placeholder="e.g 100.00" step="0.01" value="{{ isset($feesDetails) ? $feesDetails['monthly_fees'] : '' }}" required>
        @error('monthly_fees')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label required">Exam Fees</label>
        <input type="number" class="form-control @error('exam_fees') is-invalid @enderror" name="exam_fees" placeholder="e.g 100.00" step="0.01" value="{{ isset($feesDetails) ? $feesDetails['exam_fees'] : '' }}" required>
        @error('exam_fees')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
