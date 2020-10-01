@extends('layouts.retail-app')

@section('content')
<!-- main content start-->
<style type="text/css">
input[type='checkbox'] {
-webkit-appearance:none;
width:30px;
height:30px;
background:white;
border-radius:5px;
border:2px solid #555;
}
input[type='checkbox']:checked {
background: #abd;
}

@media print
{
input[type='checkbox']{display: none;}

.dropdown-toggle {display:none!important;}

button.printbtn{display: none!important;}

.btnsiscussion{display: none!important;}

.form-title
{
/*display: none!important;*/
margin-top: -200px;
border: none!important;
}

.form-title h4
{
font-weight: 700;
font-size: 24px!important;
margin-left: -12px!important;
}

.addspecial{display: none!important;}

.to_cbc{display: none!important;}

.bckchanges{display: none!important;}

.textblock{display: none!important;}

.header-section{display:none!important;}

.c_details
{
  margin-top: -80px!important; 
  background-color:#9c9e9b!important;
}

.bank_detail{margin-top: -30px!important;}

.fatca_detail{margin-top:-30px!important;}

.action{margin-top:-30px!important;}

.tables {margin-top:20px!important;}

.tables h4
{
color: #000000!important;
font-weight:600!important;
border: solid #000!important;
}

.alert{padding: 5px!important;}

img{width: 75px!important; height: 75px!important;}

.footer
{margin-top:40px!important;
display:none!important;
}

.tables .table > thead > tr > th, .tables .table > tbody > tr > th, .tables .table > tfoot > tr > th, .tables .table > thead > tr > td, .tables .table > tbody > tr > td, .tables .table > tfoot > tr > td 
{
    border-top: 1px solid #150000!important;
    line-height: 01;
}

.inv_details{margin-top:-30px!important;}

table.table tr td:nth-child(1) {
    display: none;
}

td.td_print{padding-left: 145px!important;}

td.td_print_fatca{padding-right: 200px!important;}

td.td_print_action{padding-left: 130px!important;}

}

</style>
<div id="page-wrapper">

<form method="post" action="{{url('ptc')}}">
{{csrf_field()}}

<input type="hidden" name="form_data" value="{{json_encode($form_data)}}">
<input type="hidden" name="customer_details" value="{{json_encode($customer_details)}}">
<input type="hidden" name="bank_details" value="{{json_encode($bank_details)}}">
<input type="hidden" name="investment_details" value="{{json_encode($investment_details)}}">
<input type="hidden" name="fatca_details" value="{{json_encode($fatca_details)}}">
<input type="hidden" name="other_details" value="{{json_encode($other_details)}}">
<button type="submit" class="btn btn-danger printbtn" style="">Push to CRM</button>
<br>
</form>

<button type="submit" class="btn btn-danger printbtn" onclick="window.print()" style="float: right; margin-top: -35px;">Print</button>


<div class="main-page">

  @if (session()->has('msg'))
  <br>
<div class="alert alert-info" role="alert">
<strong></strong> {{session('msg')}}
</div>
@endif

@if (session()->has('err'))
<div class="alert alert-danger" role="alert">
{{session('err')}}
</div>
@endif

<br>



<div class="form-title" style="background:rgb(227, 46, 33);">

<h4 style="color:white;">Form Id # {{$form_id}}
  <button type="button" class="btn btn-danger btnsiscussion" style="float:right;margin-top:-5px;" data-toggle="modal" data-target="#myModal">Discussion</button>

</h4>


</div>


<div class="tables">
<div class="panel-body widget-shadow">
<div id="cbc" class="modal fade" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Comments for CBC User</h4>
</div>
<div class="modal-body">
<form method="post" action="{{url('send_to_cbc')}}/{{$form_id}}">
{{csrf_field()}}
<textarea required name="msg" class="form-control" rows="4"></textarea>
<br><button type="submit" class="btn btn-danger" style="">Send To CBC</button>
</form>
</div>

</div>

</div>
</div>
<button type="button" style="float:right;margin:0px;" data-toggle="modal" data-target="#cbc"  class="btn btn-danger to_cbc">
	Send To CBC
</button>


<form  method="post" action="{{url('send_back')}}/{{$form_id}} " enctype="multipart/form-data">

<table class="table">
<tbody>
<button type="submit" class="btn btn-danger bckchanges" style="float:right; margin-right: 5px;">Send Back To Changes</button>
{{csrf_field()}}

<br>
<strong class="addspecial">Add Special Note</strong>
<br>
<textarea required name="msg" class="form-control textblock" rows="4"></textarea>
<br>

<h4 class="alert alert-danger c_details">Customer Details</h4>
<tr>
<td>
<input type="hidden" name="user_id" value="{{$form_data->user_id}}">
<input type="checkbox" name="cd[]" value="name">
</td>
<th>Name</th>
<td>{{$customer_details->name}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="father_name">
</td>
<th>Father Name</th>
<td>{{$customer_details->father_name}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="mother_name">
</td>
<th>Mother Name</th>
<td>{{$customer_details->mother_name}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="dob">
</td>
<th>Date Of Birth</th>
<td>{{$customer_details->dob}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="cnic">
</td>
<th>CNIC</th>
<td>{{$customer_details->cnic}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="cnic_attachment">
</td>
<th>CNIC Attachment</th>
<td>
<button id="cnic_attachment" type="button" style="background: none; border:none;" value="{{$customer_details->cnic_attachment}}" class="pop">
<img width="150px" height="150px" src="{{url('uploads/cnic_attachment')}}/{{$customer_details->cnic_attachment}}">
</button>
</td>
</tr>


<tr>
<td>
<input type="checkbox" name="cd[]" value="cnic_issue_date">
</td>
<th>CNIC Issue Date</th>
<td>{{$customer_details->cnic_issue_date}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="pob_country">
</td>
<th>Place Of Birth (Country)</th>
<td>{{explode('|',$customer_details->pob_country)[1]}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="pob_city">
</td>
<th>Place Of Birth (City)</th>
<td>{{explode('|',$customer_details->pob_city)[1]}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="email">
</td>
<th>Email</th>
<td>{{$customer_details->email}}</td>
</tr>


<tr>
<td>
<input type="checkbox" name="cd[]" value="cell">
</td>
<th>Cell</th>
<td>{{$customer_details->cell}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="occupation">
</td>
<th>Occupation</th>
<td>{{$customer_details->occupation}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="occ_name">
</td>
<th>Occupation name</th>
<td>{{$customer_details->occ_name}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="designation">
</td>
<th>Designatioin</th>
<td>{{$customer_details->designation}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="department">
</td>
<th>Department</th>
<td>{{$customer_details->department}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="working_experience">
</td>
<th>Working Experience</th>
<td>{{$customer_details->working_experience}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="org_emp_bes_name">
</td>
<th>Organization/Employer/Business Name</th>
<td>{{$customer_details->org_emp_bes_name}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="age_of_business">
</td>
<th>Age of Business</th>
<td>{{$customer_details->age_of_business}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="education">
</td>
<th>Education</th>
<td>{{$customer_details->education}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="marital_status">
</td>
<th>Marital Status</th>
<td>{{$customer_details->marital_status}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="no_of_dependants">
</td>
<th>No. of Dependants</th>
<td>{{$customer_details->no_of_dependants}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="public_figure">
</td>
<th>Public Figure</th>
<td>{{$customer_details->public_figure}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="average_annual_income">
</td>
<th>Average Annual Income</th>
<td>{{$customer_details->average_annual_income}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="refused_account_by_institute">
</td>
<th>Has any Financial Institution ever refused to open your account?</th>
<td>{{$customer_details->refused_account_by_institute}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="high_value_item">
</td>
<th>Do you deal high value items such as precious metal and real estate?</th>
<td>{{$customer_details->high_value_item}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="soi">
</td>
<th>Source Of Income</th>
<td>{{$customer_details->soi}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="soi_attachment">
</td>
<th>Source Of Income Attachment</th>
<td>
<button id="soi_attachment" type="button" style="background: none; border:none;" value="{{$customer_details->soi_attachment}}" class="pop">
<img width="150px" height="150px" src="{{url('uploads/soi_attachment')}}/{{$customer_details->soi_attachment}}">
</button>
</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="address">
</td>
<th>Address</th>
<td>{{$customer_details->address}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="country1">
</td>
<th>Mailing Country</th>
<td>{{explode('|',$customer_details->country1)[1]}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="city1">
</td>
<th>Mailing City</th>
<td>{{explode('|',$customer_details->city1)[1]}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="zakat">
</td>
<th>Zakat</th>
<td>{{$customer_details->zakat}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="cd[]" value="zakat_options">
</td>
<th>Zakat Option</th>
<td>{{$customer_details->zakat_options}}</td>
</tr>

@if($customer_details->zakat == 'no')
<tr>
<td>
<input type="checkbox" name="cd[]" value="zakat_certificate">
</td>
<th>Zakat Certificate</th>
<td>
<button id="zc" type="button" style="background: none; border:none;" value="{{$customer_details->zakat_certificate}}" class="pop">
<img width="150px" height="150px" src="{{url('uploads/zakat_certificates')}}/{{$customer_details->zakat_certificate}}">
</button>
</td>
</tr> 
@endif
</tbody>
</table>


<table class="table">
<tbody>

<br>
<h4 class="alert alert-danger bank_detail">Bank Details</h4>

<tr>
<td>
<input type="checkbox" name="bd[]" value="bank_name">
</td>
<th>Bank Name</th>
<td class="td_print">{{explode('|',$bank_details->bank_name)[1]}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="bd[]" value="branch_name">
</td>
<th>Branch Name</th>
<td class="td_print">{{explode('|',$bank_details->branch_name)[1]}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="bd[]" value="account_title">
</td>
<th>Account Title</th>
<td class="td_print">{{$bank_details->account_title}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="bd[]" value="iban_number">
</td>
<th>IBAN</th>
<td class="td_print">{{$bank_details->iban_number}}</td>
</tr>


</tbody>
</table>

<table class="table">
<tbody>

<br>
<h4 class="alert alert-danger inv_details">Investment Details</h4>   

<tr>
<td>
<input type="checkbox" name="ids[]" value="fund_name">
</td>
<th>Fund Name</th>
<td>{{$investment_details->fund_name}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="ids[]" value="amount">
</td>
<th>Amount</th>
<td>{{$investment_details->amount}} ({{$investment_details->amount_in_words}})</td>
</tr>

<tr>
<td>
<input type="checkbox" name="ids[]" value="payment_mode">
</td>
<th>Payment Mode</th>
<td>{{$investment_details->payment_mode}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="ids[]" value="attachment">
</td>
<th>Attachment</th>
<td>
<button id="id" type="button" style="background: none; border:none;" value="{{$investment_details->attachment}}" class="pop">
<img width="150px" height="150px" src="{{url('uploads/investment_detail_attachments')}}/{{$investment_details->attachment}}">
</button>
</td>
</tr>

<tr>
<td>
<input type="checkbox" name="ids[]" value="bank_name">
</td>
<th>Bank Name</th>
<td>{{explode('|',$investment_details->bank_name)[1]}}</td>
</tr>


<tr>
<td>
<input type="checkbox" name="ids[]" value="instrument_number">
</td>
<th>Instrument Number</th>
<td>{{$investment_details->instrument_number}}</td>
</tr>


</tbody>
</table>


<table class="table">
<tbody>

<br>
<h4 class="alert alert-danger bank_detail">Other Instructions/Information
</h4>

<tr>
<td>
<input type="checkbox" name="od[]" value="asf">
</td>
<th>Frequency of Account Statement</th>
<td class="td_print">{{$other_details->asf}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="od[]" value="dpo">
</td>
<th>Dividend pay-out</th>
<td class="td_print">{{$other_details->dpo}}</td>
</tr>


<tr>
<td>
<input type="checkbox" name="od[]" value="type_of_units">
</td>
<th>Type of Units</th>
<td class="td_print">{{$other_details->type_of_units}}</td>
</tr>



</tbody>
</table>

<table class="table">
<tbody>

<br>
<h4 class="alert alert-danger fatca_detail">Fatca Details</h4>

<tr>
<td>
<input type="checkbox" name="fd[]" value="multiple_nat">
</td>
<th>Multiple Nationalities</th>
<td class="td_print_fatca">{{$fatca_details->multiple_nat}}</td>
</tr>

@if($fatca_details->multiple_nat == 'yes')
<tr>
<td>
<input type="checkbox" name="fd[]" value="nats">
</td>
<th>Nationilty </th>
<td class="td_print_fatca">{{$fatca_details->nats}}</td>
</tr>
@endif

<tr>
<td>
<input type="checkbox" name="fd[]" value="green_card">
</td>
<th>Green Card</th>
<td class="td_print_fatca">{{$fatca_details->green_card}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="fd[]" value="for_citi">
</td>
<th>Foriegn Citizenship</th>
<td class="td_print_fatca">{{$fatca_details->for_citi}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="fd[]" value="co_ma">
</td>
<th>Care Of Mailing Address</th>
<td class="td_print_fatca">{{$fatca_details->co_ma}}</td>
</tr>


<tr>
<td>
<input type="checkbox" name="fd[]" value="co_mp">
</td>
<th>Care Of Mailing Phone Number</th>
<td class="td_print_fatca">{{$fatca_details->co_mp}}</td>
</tr>

<tr>
<td>
<input type="checkbox" name="fd[]" value="attor">
</td>
<th>Power of Attorney</th>
<td class="td_print_fatca">{{$fatca_details->attor}}</td>
</tr>


@if($fatca_details == 'yes')
<tr>
<td>
<input type="checkbox" name="fd[]" value="attor_addr">
</td>
<th>Power of Attorney</th>
<td class="td_print_fatca">{{$fatca_details->attor_addr}}</td>
</tr>
@endif


<tr>
<td>
<input type="checkbox" name="fd[]" value="trans_fund">
</td>
<th>Transfer Funds </th>
<td>{{$fatca_details->trans_fund}}</td>
</tr>


<tr>
<td>
<input type="checkbox" name="fd[]" value="wf">
</td>
<th>w8/w9 form</th>
<td>{{$fatca_details->wf}}</td>
</tr>

@if($fatca_details->wf == 'yes')
<tr>
<td>
<input type="checkbox" name="fd[]" value="wform">
</td>
<th>form</th>
<td>{{$fatca_details->wform}}</td>
</tr>
@endif

</tbody>
</table>

</form>

<br>
<table class="table">
<h4 class="alert alert-danger action">Action</h4>
<tbody>
<tr>  
<th>Sales Agent</th>
<td class="td_print_action"><strong>{{$user_name}}</strong></td>
</tr>

<tr>  
<th>Channel</th>
<td class="td_print_action">{{$form_data->channel}}</td>
</tr>

<tr>  
<th>Submitted At</th>
<td class="td_print_action">{{$form_data->created_at}}</td>
</tr>


</tbody>
</table>

<!-- Modal -->




</div>

</div>

<div class="clearfix"> </div>


</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">



<div class="container">
<div class="row">
<div class="col-md-5">
<div class="panel">
<div class="panel-heading">
<span class="glyphicon glyphicon-comment"></span> Chat
<button type="button" class="close" data-dismiss="modal">&times;</button>
<hr>

</div>
<div class="panel-body">
<ul class="chat">

@foreach($msgs as $msg)
@php 
$role = \DB::table('users')->where('id',$msg->sender_id)->pluck('role_id')[0]; 
$string = ($role == 5) ? 'CBC' : 'S';
@endphp
@if($role == 1 || $role == 5)

<li class="left clearfix" style="list-style-type: none;"><span class="chat-img pull-left">
<img src="http://placehold.it/50/55C1E7/fff&text={{$string}}" alt="User Avatar" class="img-circle" />
</span>
<div class="chat-body clearfix">
<div class="header">
<strong style="margin-left:7px;">{{DB::table('users')->where('id',$msg->sender_id)->first()->name}}</strong>
</div>
<p style="padding-left: 14%;     margin-bottom: 10%;">
{{$msg->msg}}
<br>
@php $d = new DateTime($msg->created_at);
$dates = $d->format('M d, h:i:sa');
@endphp
{{$dates}}
</p>
</div>
</li>
@else
@php
$role = \DB::table('users')->where('id',$msg->sender_id)->pluck('role_id')[0];
$string = ($role == 3) ? 'RA' : 'R';
@endphp
@if($role != 5)

<li class="right clearfix" style="list-style-type: none;"><span class="chat-img pull-right">
<img src="http://placehold.it/50/FA6F57/fff&text={{$string}}" alt="User Avatar" class="img-circle" />
</span>
<div class="chat-body clearfix">
<div class="header text-right">
<strong style="margin-left:7px;">{{DB::table('users')->where('id',$msg->sender_id)->first()->name}}</strong>
</div>
<p style="padding-right: 2%; float:right;    margin-bottom: 10%;">
{{$msg->msg}}
<br>
@php $d = new DateTime($msg->created_at);
$dates = $d->format('M d, h:i:sa');
@endphp
{{$dates}}
</p>
</div>
</li>
@endif
@endif
@endforeach


</ul>
</div>

</div>
</div>
</div>
</div>


</div>
</div>

<!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
<h4 class="modal-title" id="myModalLabel">Image preview</h4>
</div>
<div class="modal-body">
<img src="" id="imagepreview" style="width: 100%; height: auto;" >
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>

<script type="text/javascript">

$("#zc").on("click", function() {
  
var url = '<?php echo url('uploads/zakat_certificates/');?>';
$('#imagepreview').attr('src',url+'/'+ this.value);
$('#imagemodal').modal('show');
});

$("#id").on("click", function() {
  
  var url = '<?php echo url('uploads/investment_detail_attachments/');?>';
  $('#imagepreview').attr('src',url+'/'+ this.value);
  $('#imagemodal').modal('show');
  });


$("#cnic_attachment").on("click", function() {
  
  var url = '<?php echo url('uploads/cnic_attachment/');?>';
  $('#imagepreview').attr('src',url+'/'+ this.value);
  $('#imagemodal').modal('show');
  });


$("#soi_attachment").on("click", function() {
  
  var url = '<?php echo url('uploads/soi_attachment/');?>';
  $('#imagepreview').attr('src',url+'/'+ this.value);
  $('#imagemodal').modal('show');
  });


</script>
@endsection
