@extends('layouts')

@section('headerFiles')
<link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
<link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}">

<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card-block">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="">Bill Number</label>
                                    <h4><strong>##########</strong></h4>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="billing-date">Billing Date</label>
                                    <input type="date" class="form-control" id="billing-date">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Full name">
                            </div>
                            <div class="form-group">
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
                                                    <td><input type="text" name="description[]" class="form-control" placeholder="Description"></td>
                                                    <td><input type="number" name="amount" class="form-control" step="0.01" placeholder="0.00"></td>
                                                </tr>
                                                <!-- end tr -->
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td><input type="text" name="description[]" class="form-control" placeholder="Description"></td>
                                                    <td><input type="number" name="amount" class="form-control" step="0.01" placeholder="0.00"></td>
                                                </tr>
                                                <!-- end tr -->
                                                <tr>
                                                    <th scope="row" colspan="2" class="border-0">
                                                        <button type="button" class="btn btn-info btn-sm" id="addMoreFields"><i class="ti-back-left"></i> Add More</button>
                                                    </th>
                                                    <td class="text-end">
                                                        <h4 class="m-0 fw-semibold"><div id="finalPrice"><strong>Total: </strong>&#8377;</div></h4>
                                                    </td>
                                                </tr>
                                                <!-- end tr -->
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div><!-- end table responsive -->
                                </div>
                            </div>
                            <div class="form-group col-md-6 mt-5">
                                <label for="">Cheque No.</label>
                                <input type="text" name="cheque_no" value="" autocomplete="off" class="form-control" placeholder="Enter the cheque number here"/>
                            </div>
                            <div class="form-group col-md-6 mt-5">
                                <label for="">Date</label>
                                <input type="date" name="cheque_issue_date" value="" autocomplete="off" class="form-control" placeholder="Choose the cheque issue date"/>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">Bank</label>
                                <input type="text" name="bank_of_cheque" value="" autocomplete="off" class="form-control" placeholder="Enter the Bank name of the cheque" />
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">
                          <i class="fa fa-save"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger">
                          <i class="fa fa-refresh"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection

@section('footerFiles')
<script src="{{ asset('assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

<script>
    var rowCount = 1;
    var tbIndx  =   0;
    jQuery(document).ready(function($) {
        $('#addMoreFields').on('click', function () {
            rowCount++;
            tbIndx++;
            var rowHtml='<tr><th scope="row"><button type="button" class="btn btn-danger" onclick="deleteRow(this)"><i class="ti-trash"></i></button></th>'
                +'<td><input type="text" class="form-control" name="dyDescription[]" /></td>'
                +'<td><input type="number" class="form-control dyAmnt" step="0.1" name="dyAmount[]" onKeyUp="dyAmount(this)" /></td>';

                $("#invoice-table > tbody > tr").eq(tbIndx).after(rowHtml);
        });
    });

    /* This method will delete a row */
    function deleteRow(ele){
        var table = jQuery('#invoice-table')[0];
        var rowCount = table.rows.length;
        if(rowCount <= 1){
            alert("There is no row available to delete!");
            return;
        }
        if(ele){
            //delete specific row

            jQuery(ele).parent().parent().remove();
            tbIndx--;
        }
        else{
            //delete last row
            table.deleteRow(rowCount-1);
        }
    }
</script>
@endsection
