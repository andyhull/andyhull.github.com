function buildChart(){ 
		var chart;
		var yLabels =['Low', 'Medium', 'High'];
		
			// $(document).ready(function() {
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'mainGraph',
						defaultSeriesType: 'line',
						borderWidth: 0,
						spacingTop: 10
					},
					title: {
						text: 'Language Usage Over Time'
					},
					xAxis: {
						categories: ['2006', '2007', '2008', '2009', '2010','2011','2012'],
						tickmarkPlacement: 'off',
						title: {
							text: 'Year'
						}
					},
					yAxis: {
						labels: {
						            formatter: function() {
										switch(this.value){
											case 0:
											return yLabels[this.value];
											case 5:
											return yLabels[1];
											case 10:
											return yLabels[2]
										}
						            }
						        },
						title: {
							text: 'Usage',
						},
						min:0,
						max:10,
						tickInterval: 5
					},
					tooltip: {
						formatter: function() {
							return ''+
								 this.series.name +': '+ Highcharts.numberFormat(this.y, 0, ',');
						}
					},
					credits: {
						  enabled: false	
					  },
					series: [{
						data: [1, 3, 4, 6, 8, 9, 9],
						name: 'html'
					},{
						data: [1, 2, 4, 6, 8, 9, 9],
						name: 'css'
					},{	
						data: [0, 7, 7, 5, 3, 3, 3],
						name: 'php'
					}, {
						data: [0, 1, 1, 4, 7, 2, 1],
						name: 'python'
					}, {
						data: [1, 2, 3, 5, 8, 9, 9],
						name: 'javascript',
						dashStyle:'LongDash'
					},{
						data: [0, 0, 4, 0, 0,0,0],
						name: 'rails'
					}]
				});
				
				var geoChart;
				geoChart = new Highcharts.Chart({
					chart: {
						renderTo: 'geoGraph',
						defaultSeriesType: 'line',
						borderWidth: 0
					},
					title: {
						text: 'Geographic Tool Usage Over Time'
					},
					xAxis: {
						categories: ['2006', '2007', '2008', '2009', '2010','2011','2012'],
						tickmarkPlacement: 'off',
						endOnTick: false,
						        maxPadding: 0.1,
						title: {
							text: 'Year'
						}
					},
					yAxis: {
						title: {
							text: 'Usage',
						},
						min:0,
						max:10,
						tickInterval:5,
						labels: {
						            formatter: function() {
										switch(this.value){
											case 0:
											return yLabels[this.value];
											case 5:
											return yLabels[1];
											case 10:
											return yLabels[2]
										}
						            }
						        }
					},
					tooltip: {
						formatter: function() {
							return ''+
								 this.series.name +': '+ Highcharts.numberFormat(this.y, 0, ',');
						}
					},
					credits: {
						  enabled: false	
					  },
					series: [{
						data: [6, 9, 9, 7, 3,2,1],
						name: 'ArcGIS'
					},{
						data: [1, 1, 1, 3, 4,9,9],
						name: 'Quantum GIS'
					},{	
						data: [7, 8, 9, 9, 3,2,1],
						name: 'PostGIS'
					}, {
						data: [0, 0, 0, 3, 9, 9, 1],
						name: 'OpenLayers'
					}, {
						data: [0, 0, 0, 0, 0, 9, 9],
						name: 'Wax'
					},{
						data: [0, 0, 0, 0, 4, 9, 9],
						name: 'MapBox'
					}]
				});
			}