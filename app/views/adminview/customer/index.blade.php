@extends('layout.admin2')
@section('controller')
indexCtrl
@stop
@section('styles')
<link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css'>
<style type="text/css">
	.loading 
	{
		opacity: 0.5;
	}
</style>
@stop
@section('content')
<!-- modals here -->
<div class="modal fade" id="modal-update-customer" style='z-index:10000'>
	<div class="modal-dialog">
		<form method='POST' id='customer-form' action='{{ URL::to("adminsite/customer/create") }}'>
			<input type='hidden' ng-value='selectedCustomer.membership_id' name='customer_id'>
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Updated Member: <span ng-bind='selectedCustomer.membership_id'></span></h4>
				</div>
				<div class="modal-body">

					<table class="table table-hover">
						<tr>
							<td style='border-top:0'>Firstname</td>
							<td style='border-top:0'><input type='text' ng-model='selectedCustomer.firstname' name='firstname' placeholder='Firstname' class='form-control' required></td>
						</tr>
						<tr>
							<td style='border-top:0'>Lastname</td>
							<td style='border-top:0'><input type='text' ng-model='selectedCustomer.lastname' name='lastname' placeholder='Lastname' class='form-control' required></td>
						</tr>
						<tr>
							<td style='border-top:0'>Address</td>
							<td style='border-top:0'><textarea class='form-control' ng-model='selectedCustomer.address' name='address' placeholder='Address' required></textarea></td>
						</tr>
						
						<tr>
							<td style='border-top:0'>Contact no</td>
							<td style='border-top:0'><input type='text' ng-model='selectedCustomer.contact_no' name='contact_no' placeholder='Contact Number' class='form-control' required></td>
						</tr>

					</table>	</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>


	<div class="modal fade" id="modal-new-customer" style='z-index:10000'>
		<div class="modal-dialog">
			<form method='POST' id='customer-form' action='{{ URL::to("adminsite/customer/create") }}'>
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Add new customer</h4>
					</div>
					<div class="modal-body">

						<table class="table table-hover">
							<tr>
								<td style='border-top:0'>Firstname</td>
								<td style='border-top:0'><input type='text' name='firstname' placeholder='Firstname' class='form-control' required></td>
							</tr>
							<tr>
								<td style='border-top:0'>Lastname</td>
								<td style='border-top:0'><input type='text' name='lastname' placeholder='Lastname' class='form-control' required></td>
							</tr>
							<tr>
								<td style='border-top:0'>Address</td>
								<td style='border-top:0'><textarea class='form-control' name='address' placeholder='Address' required></textarea></td>
							</tr>
							<tr>
								<td style='border-top:0'>Email Address</td>
								<td style='border-top:0'><input type='email' placeholder='Email Address' class='form-control' name='email'></td>
							</tr>
							<tr>
								<td style='border-top:0'>Contact no</td>
								<td style='border-top:0'><input type='text' name='contact_no' placeholder='Contact Number' class='form-control' required></td>
							</tr>

						</table>	</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Save changes</button>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end of modals here -->
		<div class="page-header" style='margin-top:-20px'>
			<h2 style='font-family:Open Sans;'>Customers
				<button type="button" id='new-customer' class="btn btn-success pull-right" style='margin-bottom:15px;'><span class="glyphicon glyphicon-glyphicon glyphicon-plus" aria-hidden="true"></span> Add new customer</button>

			</h2>
		</div>
		<ol class="breadcrumb">
			<li>
				<a href="/adminsite/customer">Customers</a>
			</li>

			<li class="active">Index</li>
		</ol>
		<div class="container-fluid">

			<div class="row">
				@if(Session::has('error'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Error!</strong> {{ Session::get('error') }}
				</div>
				@endif
				<h2 ng-hide='items'>

				</h2>
				<div style='float:right;margin-top:23px;'>
					<input type='text' class='form-control' ng-model='searchQuery' Placeholder='Customer ID/ Customer Name Search' style='width:300px;border:2px solid #d8d8d8'>
				</div>
				<div class="row" style='padding:5px;' ng-cloak>
					<bgf-pagination
					page="page"
					per-page="perPage"
					client-limit="clientLimit"
					url="url"
					url-params = 'urlParams'
					link-group-size="2"
					collection="items">
				</bgf-pagination>

				
				<table ng-class='{"loading" : loading }' class="table table-striped table-hover">
					<thead>
						<tr>
							<th style='width:20%'>Customer ID</th>
							<th style='width:30%;'>Name </th>
							<th style='width:15%'>Created at</th>
							<th style='width:15%'>Updated at</th>
							<th style='width:20%'>
								Action
							</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-show='items.length < 1' ng-cloak>
							<td colspan="5" style='text-align:center;'>
								Nothing data to display.
							</td>
						</tr>
						<tr ng-repeat='item in items'>
							<td ng-bind='item.membership_id'></td>
							<td ng-bind='item.fullname'></td>
							<td ng-bind='item.created_at_str'></td>
							<td ng-bind='item.updated_at_str'></td>
							<td>
								<button ng-click='updateCustomer(item)' type="button" class="btn btn-xs btn-warning" style='margin:3px;'>
									<span class="glyphicon glyphicon-glyphicon glyphicon-edit" aria-hidden="true"></span>
								</button>
								<button ng-click='deleteCustomer(item.membership_id)' type="button" class="btn btn-xs btn-danger">
									<span class="glyphicon glyphicon-glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
								</button>
								<a ng-href='/adminsite/customer/[[ item.membership_id ]]/show' class="btn btn-xs btn-primary">
									<span class="glyphicon glyphicon-glyphicon glyphicon-info-sign" aria-hidden="true"></span>
								</a>

							</td>
						</tr>
					</tbody>
				</table>
				<bgf-pagination
				page="page"
				per-page="perPage"
				client-limit="clientLimit"
				url="url"
				url-params = 'urlParams'
				link-group-size="2"
				collection="items">
			</bgf-pagination>

		</bgf-pagination>
		<!-- <div class="well well-sm">
			Total of 3 records.
		</div> -->
	</div>

</div>

</div>
@stop
@section('scripts')
<script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.2.2/textAngular-sanitize.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/textAngular/1.2.2/textAngular.min.js'></script>
{{ HTML::script('admin/asset/js/customer.js') }}
@stop