function buildChart(){ 
		var chart;
		
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
						title: {
							text: 'Usage',
						},
						min:0,
					max:5,
					maxPadding: 10
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
						data: [1, 2, 3, 3, 4, 5, 5],
						name: 'html'
					},{
						data: [1, 2, 3, 3, 4, 5, 5],
						name: 'css'
					},{	
						data: [0, 1, 2, 3, 3, 3, 3],
						name: 'php'
					}, {
						data: [1, 2, 3, 3, 3, 2, 1],
						name: 'python'
					}, {
						data: [1, 2, 3, 3, 4, 5, 5],
						name: 'javascript',
						dashStyle:'LongDash'
					},{
						data: [0, 0, 2, 0, 0,0,0],
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
						max:5,
						endOnTick: false,
						        maxPadding: 100
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
						data: [4, 5, 5, 4, 3,2,1],
						name: 'ArcGIS'
					},{
						data: [1, 1, 1, 2, 2,4,4],
						name: 'Quantum GIS'
					},{	
						data: [2, 3, 4, 4, 3,2,1],
						name: 'PostGIS'
					}, {
						data: [0, 0, 0, 1, 5, 5, 1],
						name: 'OpenLayers'
					}, {
						data: [0, 0, 0, 0, 0, 5, 5],
						name: 'Wax'
					},{
						data: [0, 0, 0, 0, 2, 5, 5],
						name: 'MapBox'
					}]
				});
			}