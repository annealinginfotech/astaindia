<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Select Base course</label>
        <select name="base_course_id" id="" class="form-select @error('base_course_id') is-invalid @enderror" required>
            <option value="" selected disabled>-- Choose Base course --</option>
            @foreach ($baseCourses as $baseCourse)
                <option value="{{$baseCourse->id}}" @isset($mainCourse){{($mainCourse->base_course_id == $baseCourse->id) ? 'selected' : ''}}@endisset>{{$baseCourse->name}}</option>
            @endforeach
        </select>
        @error('base_course_id')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Name</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="e.g Scouts and guides" value="{{ isset($mainCourse) ? $mainCourse->name : '' }}" required>
        @error('name')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Course code</label>
        <input type="text" class="form-control @error('course_code') is-invalid @enderror" name="course_code" placeholder="e.g Scouts and guides" value="{{ isset($mainCourse) ? $mainCourse->course_code : '' }}" required>
        @error('course_code')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Academy name</label>
        <input type="text" class="form-control @error('academy_name') is-invalid @enderror" name="academy_name" placeholder="e.g ABCD" value="{{ isset($mainCourse) ? $mainCourse->academy_name : '' }}" required>
        @error('academy_name')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Min. Qualification</label>
        <input type="text" class="form-control @error('min_qualification') is-invalid @enderror" name="min_qualification" placeholder="e.g Scouts and guides" value="{{ isset($mainCourse) ? $mainCourse->min_qualification : '' }}" required>
        @error('min_qualification')<div class="invalid-feedback">{{$message}}</div>@enderror
    </div>
</div>
