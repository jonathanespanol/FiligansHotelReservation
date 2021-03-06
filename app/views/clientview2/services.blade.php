@extends('layout.master2')
@section('controller')
homeController
@stop
@section('styles')
<style type="text/css">
	
	.heading::first-letter {
		font-size: 150%;
		color: red;
	} 


</style>
@stop
@section('content')
<div class="row" style='padding:10px'>
	<h2 style="font-family: 'Oswald', sans-serif;">Services</h2>
	
	<hr>

	<p>24-hour Concierge and Room Service</p>
	<p>Laundry, Dry cleaning, Pressing</p>
	<p>Underground parking garage</p>
	<p>Business Center</p>
	<p>Catering and Banquet services</p>
	<p>Car rental</p>
	<p>Transfer</p>
	<p>Concert and Theatre Ticket reservation</p>
	<p>Luggage store</p>
	<p>Wireless internet connection</p>
	<p>Non-smoking or smoking room</p>
	<p>Doctor (on request)</p>
	<p>Baby sitter (on request)</p>
<p></p>
	<p>Whether you visit our design hotel for business or pleasure, the warm and personal service is sure to make your stay a delight. " Enjoy the hospitality!" with Concierge we endeavor to provide a specific, up-to-the-minute service with sightseeing recommendations and programs in and around the capital.</p>
<p></p>
	<p>Boutique Hotel Budapest**** guests can use our business services and a well-equipped meeting room.</p>
<p></p>
	<p>The concierge staff is happy to help photocopying, facsimile transmission, or any connection with general administration.</p>
<p></p>
	<p>Business services</p>
	<p>Wireless internet connection with own laptop in the rooms and in the public areas</p>
	<p>Possibility of sending faxes and copying papers</p>
	<p>Discounted phone calls within Hungary</p>
	<p>Secretary service</p>
	<p>Early check in and late check out</p>
	<p>Discounted underground parking garage</p>



</div>	
@stop
@section('scripts')
<script type="text/javascript">
	angular.module('giligansApp', [], function($interpolateProvider){
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	}).controller('homeController', ['$scope', function($scope){
	//	alert('hey')
}])
</script>
@stop