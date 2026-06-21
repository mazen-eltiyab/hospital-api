$(document).ready(function() {
	
	// Bar Chart

	var barChartData = {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
		datasets: [{
			label: 'Dataset 1',
			backgroundColor: 'rgba(0, 158, 251, 0.5)',
			borderColor: 'rgba(0, 158, 251, 1)',
			borderWidth: 1,
			data: [35, 59, 80, 81, 56, 55, 40]
		}, {
			label: 'Dataset 2',
			backgroundColor: 'rgba(255, 188, 53, 0.5)',
			borderColor: 'rgba(255, 188, 53, 1)',
			borderWidth: 1,
			data: [28, 48, 40, 19, 86, 27, 90]
		}]
	};

	var ctx = document.getElementById('bargraph').getContext('2d');
	window.myBar = new Chart(ctx, {
		type: 'bar',
		data: barChartData,
		options: {
			responsive: true,
			legend: {
				display: false,
			}
		}
	});

	// Line Chart

	var lineChartData = {
		labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		datasets: [{
			label: "My First dataset",
			backgroundColor: "rgba(0, 158, 251, 0.5)",
			data: [100, 70, 20, 100, 120, 50, 70, 50, 50, 100, 50, 90]
		}, {
		label: "My Second dataset",
		backgroundColor: "rgba(255, 188, 53, 0.5)",
		fill: true,
		data: [28, 48, 40, 19, 86, 27, 20, 90, 50, 20, 90, 20]
		}]
	};
	
	var linectx = document.getElementById('linegraph').getContext('2d');
	window.myLine = new Chart(linectx, {
		type: 'line',
		data: lineChartData,
		options: {
			responsive: true,
			legend: {
				display: false,
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			}
		}
	});
	
	// Bar Chart 2
	
    barChart();
    
    $(window).resize(function(){
        barChart();
    });
    
    function barChart(){
        $('.bar-chart').find('.item-progress').each(function(){
            var itemProgress = $(this),
            itemProgressWidth = $(this).parent().width() * ($(this).data('percent') / 100);
            itemProgress.css('width', itemProgressWidth);
        });
    };
});



// كود الجافا 
/* Revenue Overview Chart */
var ctx_rev = document.getElementById('revenue_chart').getContext('2d');
new Chart(ctx_rev, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Revenue',
            data: [35, 45, 42, 58, 52, 65],
            backgroundColor: 'rgba(204, 242, 235, 0.5)', // اللون الفاتح المظلل في الصورة
            borderColor: '#62d1b3', // لون الخط الأخضر
            borderWidth: 2,
            fill: true,
            tension: 0.4, // لجعل الخط منحني (Curvy)
            pointRadius: 0 // لإخفاء النقاط وجعله ناعم كالصورة
        }]
    },
    options: {
        responsive: true,
        legend: { display: false },
        scales: {
            yAxes: [{ ticks: { beginAtZero: true, max: 80 } }]
        }
    }
});

/* Appointments Donut Chart */
var ctx_donut = document.getElementById('appointments_donut').getContext('2d');
new Chart(ctx_donut, {
    type: 'doughnut',
    data: {
        labels: ['Cardiology', 'Neurology', 'Orthopedics', 'Pediatrics'],
        datasets: [{
            data: [30, 22, 18, 15],
            backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#36b9cc'],
            borderWidth: 5,
            hoverBorderColor: "#fff"
        }]
    },
    options: {
        cutoutPercentage: 75,
        responsive: true,
        legend: { display: false }
    }
});