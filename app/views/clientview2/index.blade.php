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
	<h2 style="font-family: 'Oswald', sans-serif;">Welcome to Giligans Hotel</h2>
	<p>
		At Giligans Hotel good things come
		together to whip up a worry-free
		hotel experience. With great location,
		affordable pricing, clean and secure
		rooms, and the full assistance of our
		staff, guests are able to make the
		most out of their stay in Palawan.
		At the end of a long day, when it’s
		time to rest your head, our no-frills
		accommodation and well-trained
		personnel will give you
		more time to relax and
		unwind comfortably.
	</p>
	<hr>
</div>	
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

		<img src="{{ URL::to('image/large/1.jpg') }}" class='img-responsive' alt="">
		<h2 class='heading' style="font-family: 'Open Sans', sans-serif;">Rooms</h2>
		<p>
			At Pals Hotel, good things come
			together to whip up a worry-free
			hotel experience. With great location,
			affordable pricing, clean and secure
			rooms, and the full assistance of our
			staff, guests are able to make the
			most out of their stay in Palawan.
			At the end of a long day, when it’s
			time to rest your head, our no-frills
			accommodation and well-trained
			personnel will give you
			more time to relax and
			unwind comfortably.
		</p>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

		<img src="{{ URL::to('image/large/2.jpg') }}" class='img-responsive' alt="">
		<h2 class='heading' style="font-family: 'Open Sans', sans-serif;">Services</h2>
		<p>
			At Pals Hotel, good things come
			together to whip up a worry-free
			hotel experience. With great location,
			affordable pricing, clean and secure
			rooms, and the full assistance of our
			staff, guests are able to make the
			most out of their stay in Palawan.
			At the end of a long day, when it’s
			time to rest your head, our no-frills
			accommodation and well-trained
			personnel will give you
			more time to relax and
			unwind comfortably.
		</p>
	</div>
	
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<img src="{{ URL::to('image/large/3.jpg') }}" class='img-responsive' alt="">
		<h2 class='heading' style="font-family: 'Open Sans', sans-serif;">Location</h2>
		<p>
			Pals Hotel is less than 10 minutes
			away from the Puerto Princesa
			International Airport. It is in the
			same vicinity as the Provincial
			Capitol, popular souvenir shops,
			and several must-visit places in
			Palawan.
		</p>
	</div>


	
</div>
@stop
@section('scripts')
<script type="text/javascript">
	$('.checkin').datepicker({
		format: 'yyyy-mm-dd',
		startDate: '0d'
	})
</script>
<script type="text/javascript">

	angular.module('giligansApp', [], function($interpolateProvider){
		$interpolateProvider.startSymbol('[[');
		$interpolateProvider.endSymbol(']]');
	}).controller('homeController', ['$scope', function($scope){
		$scope.availability = {
			checkin : null,
			checkout : moment().add(1, 'days').format('YYYY[-]MM[-]DD'),
			display_checkout : moment().add(1, 'days').format('YYYY[-]MM[-]DD')
		}
		$scope.nights=null;
		$scope.$watch('availability.checkin', function(newVal, oldVal){
			if($scope.nights>1){
				$scope.availability.checkout = moment(newVal).add($scope.nights, 'days').format('YYYY[-]MM[-]DD');
				$scope.availability.display_checkout = moment(newVal).add($scope.nights, 'days').format('YYYY[-]MM[-]DD');

			}else if($scope.nights==1){
				$scope.availability.display_checkout = moment(newVal).add(1, 'days').format('YYYY[-]MM[-]DD');
				$scope.availability.checkout = moment(newVal).add(1, 'days').format('YYYY[-]MM[-]DD');

			}

		});
		$scope.$watch('nights', function(newVal, oldVal){
			if(newVal<1){
				$scope.nights=1;
			}
			if(newVal>1){
				$scope.availability.checkout = moment($scope.availability.checkin).add(newVal, 'days').format('YYYY[-]MM[-]DD');
				$scope.availability.display_checkout = moment($scope.availability.checkin).add(newVal, 'days').format('YYYY[-]MM[-]DD');
				console.log($scope.availability.display_checkout);

			}else if(newVal==1){
				$scope.availability.checkout = moment($scope.availability.checkin).add(1, 'days').format('YYYY[-]MM[-]DD');
				$scope.availability.display_checkout = moment($scope.availability.checkin).add(1, 'days').format('YYYY[-]MM[-]DD');

			}
   // console.log($scope.availability.checkout)
})
	}]).directive('validNumber', function() {

		return {
			require: '?ngModel',
			link: function(scope, element, attrs, ngModelCtrl) {
				if(!ngModelCtrl) {
					return; 
				}

				ngModelCtrl.$parsers.push(function(val) {
					if (angular.isUndefined(val)) {
						var val = '';
					}
					var clean = val.replace( /[^0-9]+/g, '');
					if (val !== clean) {
						ngModelCtrl.$setViewValue(clean);
						ngModelCtrl.$render();
					}
					return clean;
				});

				element.bind('keypress', function(event) {
					if(event.keyCode === 32) {
						event.preventDefault();
					}
				});
			}
		};
	});

</script>
@stop