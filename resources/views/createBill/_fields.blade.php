<div class="form-row">
    <div class="form-group col-md-3">
        <label for="">Bill Number</label>
        <h4><strong>{{ $latestBillNumber }}</strong></h4>
    </div>
    <div class="form-group col-md-6">
        <label for="branch-name">Branch</label><code>*</code>
        <input type="text" id="branch-name" name="branch" value="@isset($billInformation){{ $billInformation->branch }}@endisset" placeholder="Enter the branch name" class="form-control @error('branch') is-invalid @enderror" />
        @error('branch')
            <span id="branch-name-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label for="billing-date">Billing Date</label><code>*</code>
        <input type="date" class="form-control @error('billing_date') is-invalid @enderror" name="billing_date" value="@isset($billInformation){{$billInformation->billing_date->format('Y-m-d')}}@endisset" id="datepickerID">
        @error('billing_date')
            <span id="billing-date-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="name">Name</label><code>*</code>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full name" value="@isset($billInformation){{ $billInformation->name }}@endisset">
    @error('name')
        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-row mt-5">
    <div class="form-group col-md-2">
        <label for="fees-type">Fees Type</label><code>*</code>
        <select class="form-control @error('fees_type') is-invalid @enderror" name="fees_type" id="fees_type">
            <option value="" selected disabled>-- Select fees type --</option>
            <option value="admission" @isset($billInformation) {{ ($billInformation->fees_type == 'admission') ? 'selected' : '' }} @endisset>Admission Fees</option>
            <option value="monthly" @isset($billInformation) {{ ($billInformation->fees_type == 'monthly') ? 'selected' : '' }} @endisset>Monthly Fees</option>
            <option value="others" @isset($billInformation) {{ ($billInformation->fees_type == 'others') ? 'selected' : '' }} @endisset>Others</option>
        </select>
        @error('fees_type')
            <span id="fees-type-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="month">Month</label><code>*</code>
        <select class="form-control @error('month') is-invalid @enderror" name="month" id="month">
            <option value="" selected disabled>-- Select month --</option>
            @foreach ($billingMonthRange as $month)
                <option value="{{ $month }}" @isset($billInformation) {{ ($billInformation->month == $month) ? 'selected' : '' }} @endisset>{{ $month }}</option>
            @endforeach
        </select>
        @error('month')
            <span id="month-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-2">
        <label for="year">Year</label><code>*</code>
        <select class="form-control @error('year') is-invalid @enderror" name="year" id="year">
            <option value="" selected disabled>-- Select year --</option>
            @foreach ($billingYearRange as $year)
                <option value="{{ $year }}" @isset($billInformation) {{ ($billInformation->year == $year) ? 'selected' : '' }} @endisset>{{ $year }}</option>
            @endforeach
        </select>
        @error('year')
            <span id="year-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-3">
        <label for="total-amount">Amount</label><code>*</code>
        <input type="number" id="total-amount" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" step="0.01" placeholder="0.00" value="@isset($billInformation){{ $billInformation->total_amount }}@endisset">
        @error('total_amount')
            <span id="total-amount-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-2">
        <label for="payment-mode">Payment Mode</label><code>*</code>
        <select class="form-control @error('payment_mode') is-invalid @enderror" name="payment_mode" id="payment_mode">
            <option value="" selected disabled>-- Select payment mode --</option>
            <option value="cash" @isset($billInformation) {{ ($billInformation->payment_mode == 'cash') ? 'selected' : '' }} @endisset>Cash</option>
            <option value="online" @isset($billInformation) {{ ($billInformation->payment_mode == 'online') ? 'selected' : '' }} @endisset>Online/UPI</option>
        </select>
        @error('payment_mode')
            <span id="payment-mode-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

</div>




<div class="form-row">
    <div class="form-group col-md-6 mt-5">
        <label for="">Cheque No.</label>
        <input type="text" name="cheque_no" value="@isset($billInformation){{ $billInformation->cheque_no }}@endisset" autocomplete="off" class="form-control" placeholder="Enter the cheque number here"/>
    </div>
    <div class="form-group col-md-6 mt-5">
        <label for="">Date</label>
        <input type="date" name="cheque_issue_date" value="@isset($billInformation->cheque_issue_date){{$billInformation->cheque_issue_date->format('Y-m-d')}}@endisset" autocomplete="off" class="form-control" placeholder="Choose the cheque issue date"/>
    </div>
    <div class="form-group col-md-12">
        <label for="">Bank</label>
        <input type="text" name="bank_of_cheque" value="@isset($billInformation){{ $billInformation->bank_of_cheque }}@endisset" autocomplete="off" class="form-control" placeholder="Enter the Bank name of the cheque" />
    </div>
    <div class="form-group col-md-12 mt-2">
        <hr/>
    </div>
</div>


    <div class="form-row">
        <div class="col-md-12">
            <button type="reset" class="btn btn-danger">
                <i class="fa fa-refresh"></i> Reset
            </button>

            <button name="action" value="save" type="submit" class="btn btn-success float-right">
                <i class="fa fa-save"></i>
                @if (isset($billInformation))
                    Update
                @else
                    Save
                @endif
            </button>
        </div>
    </div>
        {{-- <div class="form-group col-md-4">
            <button name="action" value="save_and_print" type="submit" class="btn btn-info float-right">
                <i class="fa fa-print"></i>
                @if (isset($billInformation))
                    Update & Print
                @else
                    Save & Print
                @endif
            </button>
        </div> --}}



