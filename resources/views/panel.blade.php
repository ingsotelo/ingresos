@extends('layouts.app')
@section('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"/>
<style type="text/css">
  
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            	<div class="card-header">
			        Dashboard
			    </div>
                <div class="card-body shadow">
                	<div class="card-deck">
					  <div class="card">
					  	<div class="card-header  text-center text-white bg-success shadow">
			            	Contribuyentes Totales <b>89</b>
			            </div>
					    <div class="card-body shadow">
					    	<div class="row">
						    	<div class="col-md-12">
						      		<canvas id="myChart2"></canvas>
					      		</div>
					    	</div>
					    </div>
					  </div>

					  <div class="card">
					  	<div class="card-header  text-center text-white bg-success shadow">
			            	Contribuyentes por Obligacion
			            </div>
					    <div class="card-body shadow">
					    	<div class="row">
						    	<div class="col-md-12">
						    		<canvas id="myChart"></canvas>
					      		</div>
					    	</div>
					    </div>
					  </div>

					  <div class="card">
					  	<div class="card-header  text-center text-white bg-success shadow">
			            	Metodos de Pagos Usados
			            </div>
					    <div class="card-body shadow">
					      	<div class="row">
						    	<div class="col-md-12">
						    		<canvas id="myChart3"></canvas>
					      		</div>
					    	</div>
					    </div>
					  </div>


					</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
	<script type="text/javascript">
		
		var MONTHS = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];	
		var arr = [], arrData = [];
		for(var i=1; i<=30; i++) {
		   arr.push(i.toString());
		   arrData.push(i);
		}

		var config1 = {
		    type: 'line',
		    data: {
		        labels: arr,
		        datasets: [{
		            label: 'Ultimos 30 Dias',
		            //backgroundColor: 'rgb(255, 99, 132)',
		            borderColor: 'rgb(255, 99, 132)',
		            data: arrData
		        }]
		    },
		    options: {
		    	responsive: true
		    }
		};

		var config2 = {
		    type: 'doughnut',
		    data: {
		        labels: ['Activos (30%)','Inactivos (70%)'],
		        datasets: [{
		            label: 'Ultimos 30 Dias',
		            backgroundColor: ['rgb(255, 99, 132)','rgb(75, 192, 192)'],
		            data: [30,49]
		        }]
		    },
		    options: {
		    	responsive: true,
				legend: {
					position: 'left',
					//display: false,
				}
			}
		};

		var config3 = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						15,
						35,
						20,
						30,
					],
					backgroundColor: [
						'rgb(255, 159, 64)',
						'rgb(255, 205, 86)',
						'rgb(54, 162, 235)',
						'rgb(255, 99, 132)'
					],
				}],
				labels: [
					'CoDi',
					'Tarjeta',
					'Caja',
					'Referencia'
				]
			},
			options: {
				responsive: true,
				legend: {
						position: 'left',
						//display: false,
					}
			}
		};


	var config4 = {
		type: 'bar',
		data: {
			labels: ['Nomina', 'Hospedaje', 'Tenencia', 'Medicos'],
			datasets: 
			[{
				backgroundColor: 'rgb(255, 159, 64)',
				borderColor: 'rgb(255, 159, 64)',
				borderWidth: 1,
				data: [
					10,
					20,
					30,
					40,
					0
				]
			},
			]
			},
		options: {
					responsive: true,
					legend: {
						position: 'top',
						display: false,
					}
		}
	};


		window.onload = function() {
			var ctx1 = document.getElementById('myChart').getContext('2d');
			var ctx2 = document.getElementById('myChart2').getContext('2d');
			var ctx3 = document.getElementById('myChart3').getContext('2d');
			window.myPie = new Chart(ctx1, config4);
			window.myDoughnut = new Chart(ctx2, config2);
			window.myPie = new Chart(ctx3, config3);
		};
		
	</script>
	

@endsection


	