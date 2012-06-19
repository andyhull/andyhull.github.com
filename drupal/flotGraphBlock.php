<?php
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $header_classes: An array of header classes keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $classes: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * - $field_classes: An array of classes to apply to each field, indexed by
 *   field id, then row number. This matches the index in $rows.
 * @ingroup views_templates
 */
?>
<?php
$js_array = json_encode($rows);
$header_array = json_encode($header);
echo "<script>var programData = ". $js_array . "; var dataLabels = ". $header_array.";</script>";
?>
	<div class="span8">
		<p>Using the tools below, users can filter programs by category (electronic payments, total households, annual program cost, etc). In addition, users can select variables on the x and y-axis to see clearer visual representations of how programs compare to each other.</p>
		<form id="axes" action="">
			<div id="yaxis" style="">Y Axis
				<select id="ySelect" name="y" style="cursor: pointer;margin: 1px 0 0;padding: 10px;"></select>
			</div>
			<!-- <div id="xaxis" style="position:relative;top:150px;">X Axis
							<select id="xSelect" name="x" style="cursor: pointer;margin: 1px 0 0;padding: 10px;"></select>
						</div> -->
		</form>
		<div id="programsGraph" style="width:600px;height:100px;"></div>
	</div><!-- end .span8-->

<divstyle="position:relative;top:40px;padding-bottom:50px;padding-top:30px;">
	<div class="span12">
		<h3>All Programs</h3>
	</div><!-- end .span12-->
</div> <!-- end .row-->

<script>
// We define a function that takes one parameter named $.
(function ($) {
	//Here is where we build the data
	var plotData = [];
	var plotNames = [];
	//loop through the headers
	for(label in dataLabels){
		switch(label){
			case 'title':
				break;
			case 'field_total_households':
				$('#ySelect').append('<option style="color:#333;" value="'+label+'" selected="selected">'+dataLabels[label]+'</option>');
				// $('#xSelect').append('<option style="color:#333;" value="'+label+'">'+dataLabels[label]+'</option>');
				break;
			case 'field_annual_program_cost_usd':
				// $('#xSelect').append('<option style="color:#333;" value="'+label+'" selected="selected">'+dataLabels[label]+'</option>');
				$('#ySelect').append('<option style="color:#333;" value="'+label+'">'+dataLabels[label]+'</option>');
				break;
			default:
				$('#ySelect').append('<option style="color:#333;" value="'+label+'">'+dataLabels[label]+'</option>');
				// $('#xSelect').append('<option style="color:#333;" value="'+label+'">'+dataLabels[label]+'</option>');
		} // end switch
	} //end for label
	
	for(value in programData){
		var households, individuals = 0;
		plotData[value]=[];
		// if(programData[value]['field_total_households'] !=''){
		// 	var xPlotData;
		// 	xPlotData = programData[value]['field_total_households'].replace(' ','')
		// 	xPlotData = programData[value]['field_total_households'].replace(',','')
		// 	households = parseFloat(xPlotData);
		// }
		if(programData[value]['field_annual_program_cost_usd']!=''){
			var yPlotData;
			yPlotData = programData[value]['field_annual_program_cost_usd'].replace(' ','')
			yPlotData = programData[value]['field_annual_program_cost_usd'].replace(',','')
			individuals = parseFloat(yPlotData);
		}
		plotData[value].push(households, individuals);
	} //end for value
	$("select option:selected").each(function () {
		plotNames.push($(this).attr('value'));
	});
	
	createGraph();
	
	//Update the graph when the select boxes change
	$("select").change(function () {
		plotData=[]
		plotNames = [];
		
        $("select option:selected").each(function () {
			plotNames.push($(this).attr('value'));
		});
		//loop through all the country data and add it to plotData
		for(value in programData){
			plotData[value]=[];
			var xPlot, yPlot = 0;
			// console.log(programData[value][[plotNames][0][1]])
			// if(programData[value][[plotNames][0][1]] !=''){
			// 	var xPlotData;
			// 	xPlotData = programData[value][[plotNames][0][1]].replace(' ','')
			// 	xPlotData = programData[value][[plotNames][0][1]].replace(',','')
			// 	xPlotData = programData[value][[plotNames][0][1]].replace('$','')
			// 	xPlot = parseFloat(xPlotData);
			// }
			// console.log(programData[value][[plotNames][0][0]])
			if(programData[value][[plotNames][0][0]]!=''){
				var yPlotData;
				yPlotData = programData[value][[plotNames][0][0]].replace(' ','')
				yPlotData = programData[value][[plotNames][0][0]].replace(',','')
				yPlotData = programData[value][[plotNames][0][0]].replace('$','')
				yPlot = parseFloat(yPlotData);
			}
			plotData[value].push(xPlot, yPlot);
		}
		createGraph();
	});
	

	function createGraph(){
		$('#programsGraph').empty();
		//charting options
		var options = {
		    xaxis: {
		        tickColor: '#f4f4f4',
		        autoscaleMargin: 0.1,
		        tickDecimals: 0,
				// show: true,
				label: 'Total Households'
		    },
		    yaxis: {
		        // tickFormatter: function() { return ''; },
		        tickColor: '#f4f4f4',
		        autoscaleMargin: 0.1,
				label: 'Total Individuals'
		    },
		    series: {
		        lines: {
		            show: false,
		            lineWidth: 0.5,
		            fillColor: '#000000'
		        },
		        points: {
		            show: false,
		            fillColor: '#000000',
		            radius: 4,
		            lineWidth: 2
		        },
				bars: {
		            show: true,
		            lineWidth: 0,
		            fillColor: '#cccccc'
		        },
		        shadowSize: 0
		    },
		    colors: ["#0064CD"],
		    grid: {
		        show: true,
		        borderWidth: 0,
		        hoverable: true,
		        clickable: true
		     }
		};
		//main loop for plotting the graphs
		var e = $('#programsGraph');
		// console.log(plotData)
		var plot = $.plot(e, [plotData], options);
			var previousPoint = null;
			$('#programsGraph').bind("plothover", function (event, pos, item) {
				    $("#x").text(pos.x.toFixed(2));
				    $("#y").text(pos.y.toFixed(2));
				    if (item) {
					    if (previousPoint != item.dataIndex) {
			                previousPoint = item.dataIndex;
		                	$("#tooltip").remove();
		                	var x = item.datapoint[0],
		                    	y = item.datapoint[1];
		                	showTooltip(item.pageX, item.pageY, programData[item.dataIndex]['title'] +'<br/> '+dataLabels[plotNames[1]]+': '+ x+' '+dataLabels[plotNames[0]]+': '+y);
		            	}
			        }
				});
			} //end createGraph
	
	
	function showTooltip(x, y, contents) {
        $('<div id="tooltip">' + contents + '</div>').css( {
            position: 'absolute',
            display: 'none',
            top: y + 10,
            left: x + 10,
            border: '1px solid #ccc',
            padding: '2px',
            'background-color': '#eee',
			'z-index': 1000,
			'font-weight':500,
            opacity: 0.75
        }).appendTo("body").fadeIn(200);
    } //end showTooltip

// Here we immediately call the function with jQuery as the parameter.
}(jQuery));

</script>