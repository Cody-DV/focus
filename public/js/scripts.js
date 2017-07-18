/**
 * scripts.js
 *
 * Computer Science 50
 * Problem Set 7
 *
 * Global JavaScript, if any.
 */


// Generates a CanvasJS chart
function generateChart(data, container, title, label, legend, type) {
    var dataPoints = [];
    $.each(data, function(key, value) {
        dataPoints.push({x: value["focus"], y: parseInt(value["totalTime"]), legendText: value[legend]});
        
    });
    console.log(dataPoints);
    
    if(dataPoints !== 'undefined'){
        var chart = new CanvasJS.Chart(container,
        {
            title:{
                text: title
            },
            legend: {
                maxWidth: 350,
                itemWidth: 120
            },
            
            data: [{
                type: type,
                showInLegend: true,
                toolTipContent: "{legendText}: #percent% ({y} Minutes)",
                dataPoints: dataPoints,
            }]
        });
        chart.render();
    }
    else{
        console.log('No data');
    }    
}


// Chart 1
$(function() {
    
    $.getJSON("data.php?dataSet=1", function(data){ 
        generateChart(data, "chartContainer1", "Focus Distribution", "focus", "focus", "pie");
        
    });
});

// Chart 2

$(function() {
    
    $.getJSON("data.php?dataSet=2", function(data){
        generateChart(data, "chartContainer2", "Focus Time - This Month", "focus", "Time", "doughnut");
        
    });
});


// Chart 3
$(function() {
    
    $.getJSON("data.php?dataSet=3", function(data){
        generateChart(data, "chartContainer3", "Focus Time - This Week", "focus", "Time", "doughnut");
    });
});

// Adjust timezone to account for offset
function adjustTimeZone(dateString)
{
    var date = new Date(dateString);
    var timezoneOffsetMillis = date.getTimezoneOffset() * 60 * 1000;
    var newDateMillis = date.getTime() + timezoneOffsetMillis;
    return new Date(newDateMillis);
}


// Chart 4
$(function() {
    var dataPoints = [];
    $.getJSON("data.php?dataSet=4", function(data) {
        console.log(data);
        $.each(data, function(key, value) {

            
            dataPoints.push({x: adjustTimeZone(value["date"]), y: parseInt(value["totalTime"]), indexLabel: value["totalTime"]});

        });
    
		
				var usersSplineChart = new CanvasJS.Chart("users-spline-chart", {
					animationEnabled: true,
					backgroundColor: "transparent",
					axisX: {
						gridThickness: 0,
						labelFontColor: "#bbbbbb",
						lineColor: "#bbbbbb", 
						valueFormatString: "DD-MMM"
					},
					axisY: {
						gridThickness: 0,
						labelFontColor: "#bbbbbb",
						lineColor: "#bbbbbb"
					},
					legend: {
						dockInsidePlotArea: true,
						fontColor: "#ffffff",
						fontSize: 16,
						horizontalAlign: "right",
						verticalAlign: "top"
					},
					toolTip: {
						backgroundColor: "#000000",
						borderThickness: 2,
						cornerRadius: 0,
						fontColor: "#ffffff",
						shared: true
					},
					data: [
						{
							color: "#1a3f7a",
							legendMarkerType: "square",
							legendText: "Focus",
							name: "Focus Time (minutes)",
							showInLegend: false,						
							type: "spline",
							dataPoints: dataPoints,
							
						}
						
					]
				
				});

		usersSplineChart.render();
		
    });
});