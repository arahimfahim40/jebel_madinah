@extends('admin.layout.main')
@section('title','invoices')
<style type="text/css">
    label {
        font-weight: bold;
    }
</style>
@section('content')
<div class="site-content">
    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header clearfix">
                    <h5 class="float-xs-left mb-0">Edit Invoice</h5>
                </div>
                <div class="card-block">
                    <div class="row mb-2">
                        <!-- /.box-header -->
                        <div class="col-md-12 col-md-offset-0">
                            <form action="{{route('update_invoice_admin')}}" method="post" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="col-md-12">
                                    <input type="hidden" name="id" value="{{@$invoice->id}}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Invoice Number</label>
                                            <input type="text" name="inv_number" value="{{@$invoice->inv_number}}" id="name" class="form-control" placeholder="Invoice Number" />
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Invoice Date</label>
                                            <input type="date" name="inv_date" value="{{@$invoice->inv_date}}" class="form-control" placeholder="Invoice Date" />
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Purpose</label>
                                            <input type="text" name="purpose" value="{{@$invoice->purpose}}" class="form-control" placeholder="Purpose" />
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Invoice Due Date</label>
                                            <input type="date" name="inv_due_date" value="{{@$invoice->inv_due_date}}" class="form-control" placeholder="Invoice Due Date" />
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Select Company</label>
                                            <select name="comp" id="" class="select2" style="width: 100%">
                                                <?php $compo = DB::table('companies')->whereNull('deleted_at')->where('id', isset($invoice) ? $invoice->company_id : '')->first(); ?>
                                                <option value="<?php echo $compo->id ?>"><?php echo $compo->name ?></option>
                                                @foreach($company as $compe)
                                                <option value="{{$compe->id}}">{{$compe->name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="name">Check Status</label>
                                            <select name="checksstatus" id="" class="select2" style="width: 100%">
                                                <option value="0" <?php if ($invoice->checks == 0) echo "selected" ?>>Unchecked</option>
                                                <option value="1" <?php if ($invoice->checks == 1) echo "selected" ?>>Checked</option>
                                            </select>

                                        </div>

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Select Container</label>
                                            <select name="cont" id="" class="select2" style="width: 100%">
                                                <?php $conto = DB::table('containers')->whereNull('deleted_at')->where('id', isset($invoice) ? $invoice->container_id : '')->first(); ?>
                                                @if(!empty($conto))
                                                <option value="<?php echo $conto->id ?>"><?php echo $conto->container_number ?></option>
                                                @else
                                                <option value=""></option>
                                                @endif
                                                <?php $conti_find = DB::table('containers')->whereNull('deleted_at')->get();
                                                foreach ($container as $cont) { ?>
                                                    <option value="{{$cont->id}}">{{$cont->container_number}}</option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="name">Invoice Amount</label>
                                            <input type="text" name="inv_amount" value="{{@$invoice->inv_amount}}" class="form-control" placeholder="Invoice Amount" />
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Payment Received</label>
                                            <input type="text" name="payment_rece" value="{{@$invoice->payment_rece}}" class="form-control" placeholder="Payment Received" />
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Received Date</label>
                                            <input type="date" name="rece_date" value="{{@$invoice->rece_date}}" class="form-control" placeholder="Received Date" />
                                        </div>

                                        <div class="form-group">
                                            <label for="name">Method of Payment</label>
                                            <input type="text" name="payment_method" value="{{@$invoice->payment_method}}" class="form-control" placeholder="Method of Payment" />
                                        </div>
                                        <div class="form-group">
                                            <label for="evidence_proof">Evidence Proof </label>
                                            <input type="text" name="evidence_proof" value="{{@$invoice->evidence_proof}}" class="form-control" placeholder="Evidence Goolge Drive Link" />

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <textarea name="description" placeholder="Description" style="width: 100%; height: 150px;"><?= @$invoice->description ?></textarea>
                                    </div>
                                </div>
                                <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="card-footer clearfix">
                        <button type="submit" class="btn btn-info label-left float-xs-left btn-rounded">
                            <span class="btn-label"><i class="ti-save"></i></span>
                            Edit
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    @stop