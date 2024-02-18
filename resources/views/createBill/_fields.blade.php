<div class="form-row">
    <div class="form-group col-md-3">
        <label for="">Bill Number</label>
        <h4><strong>{{ $latestBillNumber }}</strong></h4>
    </div>
    <div class="form-group col-md-6">
        <label for="branch-name">Branch</label>
        <input type="text" id="branch-name" name="branch" value="@isset($billInformation){{ $billInformation->branch }}@endisset" placeholder="Enter the branch name" class="form-control @error('branch') is-invalid @enderror" />
        @error('branch')
            <span id="branch-name-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group col-md-3">
        <label for="billing-date">Billing Date</label>
        <input type="date" class="form-control @error('billing_date') is-invalid @enderror" name="billing_date" value="@isset($billInformation){{$billInformation->billing_date->format('Y-m-d')}}@endisset" id="datepickerID">
        @error('billing_date')
            <span id="billing-date-error" class="error invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Full name" value="@isset($billInformation){{ $billInformation->name }}@endisset">
    @error('name')
        <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
    @enderror
</div>

<div class="form-row">
    <div class="form-group col-md-12">
        <div class="col-12 mt-5">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap table-centered mb-0" id="invoice-table">
                    <thead>
                        <tr>
                            <th style="width: 100px;">Sl. No.</th>
                            <th>Description</th>
                            <th>Amount</th>
                        </tr>
                    </thead><!-- end thead -->
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description" value="@isset($billInformation){{ $billInformation->description }}@endisset">
                                @error('description')
                                    <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="number" name="total_amount" class="form-control @error('total_amount') is-invalid @enderror" step="0.01" placeholder="0.00" value="@isset($billInformation){{ $billInformation->total_amount }}@endisset">
                                @error('total_amount')
                                    <span id="amount-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                        <!-- end tr -->
                    </tbody><!-- end tbody -->
                </table><!-- end table -->
            </div><!-- end table responsive -->
        </div>
    </div>
</div>



<div class="form-row">
    <div class="form-group col-md-6 mt-5">
        <label for="">Cheque No.</label>
        <input type="text" name="cheque_no" value="@isset($billInformation){{ $billInformation->cheque_no }}@endisset" autocomplete="off" class="form-control" placeholder="Enter the cheque number here"/>
    </div>
    <div class="form-group col-md-6 mt-5">
        <label for="">Date</label>
        <input type="date" name="cheque_issue_date" value="@isset($billInformation){{$billInformation->cheque_issue_date->format('Y-m-d')}}@endisset" autocomplete="off" class="form-control" placeholder="Choose the cheque issue date"/>
    </div>
    <div class="form-group col-md-12">
        <label for="">Bank</label>
        <input type="text" name="bank_of_cheque" value="@isset($billInformation){{ $billInformation->bank_of_cheque }}@endisset" autocomplete="off" class="form-control" placeholder="Enter the Bank name of the cheque" />
    </div>
    <div class="form-group col-md-12 mt-2">
        <hr/>
    </div>

    <div class="container-fluid">
        <div class="form-row">
            <div class="form-group col-md-4 float-left">
                <button type="reset" class="btn btn-danger">
                    <i class="fa fa-refresh"></i> Reset
                </button>
            </div>

            <div class="form-group col-md-4 text-center">
                <button name="action" value="save" type="submit" class="btn btn-success">
                    <i class="fa fa-save"></i>
                    @if (isset($billInformation))
                        Update
                    @else
                        Save
                    @endif
                </button>
            </div>

            <div class="form-group col-md-4">
                <button name="action" value="save_and_print" type="submit" class="btn btn-info float-right">
                    <i class="fa fa-print"></i>
                    @if (isset($billInformation))
                        Update & Print
                    @else
                        Save & Print
                    @endif
                </button>
            </div>
        </div>
    </div>
</div>

