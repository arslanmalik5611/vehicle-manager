$(document).ready(function () {
    line_chart_draw();
    class_student_count_load();
    fee_collect_count_load();
    donut_chart_draw();
    pie_chart_draw();
    recent_activities();
});

function class_student_count_load() {
    $.ajax({
        url: api_url + 'dashboard/class-student-count',
        dataType: "JSON",
        method: 'GET',
        success: function (response) {
            var mainRow = '';
            var count = 1;
            $(response.data).each(function (i, data) {
                mainRow += `
                <tr>
                <td>${count++}</td>
                <td>${data.name}</td>
                <td>${data.student_enrollments_count}</td>
                </tr>`;
            });
            $('.classEnrBody').html(mainRow);
        }

    });
}

function fee_collect_count_load() {
    $.ajax({
        url: api_url + 'dashboard/monthly-fee-count',
        dataType: "JSON",
        method: 'GET',
        success: function (response) {
            var data = response.data;
            var mainRow = '';
            var count = 1;
            for (const key in data) {
                var fee = data[key];
                var mainTd = '';
                for (const value in fee) {
                    var total = '-';
                    if(fee[value]){
                        total = Number(fee[value]) + Number(0);
                    }
                
                    mainTd += `<td>${total}</td>`;
                }
                mainRow += `
                <tr>
                <td>${count++}</td>
                <td>${key}</td>
               ${mainTd}
                </tr>`;

            }
            $('.feeDetailShow').html(mainRow);
        }

    });
}

$(document).on('click', '#total_patients_div', function () {
    window.open(base_url + 'patients?cc=' + $('#collection_center_id').val() + '&duration=' + $('#duration-filter').val() + '&date=' + $('#duration-date-from').val());
});
$(document).on('click', '#pending_reports_div', function () {
    window.open(base_url + 'patients/pending-report?cc=' + $('#collection_center_id').val() + '&duration=' + $('#duration-filter').val() + '&date=' + $('#duration-date-from').val());
});
$(document).on('click', '#pending_emails_div', function () {
    window.open(base_url + 'patients/pending-report-email?cc=' + $('#collection_center_id').val() + '&duration=' + $('#duration-filter').val() + '&date=' + $('#duration-date-from').val());
});

$(document).on('click', '.filter-stats-btn', function () {
    dashboard_load();
    line_chart_draw();
});

$(document).on('change', '#duration-filter', function () {
    $('#duration-date-from').val('');
    if ($(this).val() == 'custom') {
        $('#date-filter').show();
    } else {
        $('#date-filter').hide();
    }
});

function line_chart_draw() {
    $.ajax({
        url: api_url + "dashboard/line-chart",
        method: 'get',
        dataType: 'json',
        success: function (response) {
            //Line Chart
            var options = {
                series: response.data,
                chart: {
                    height: 350,
                    type: 'line',
                    dropShadow: {
                        enabled: true,
                        color: '#000',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: response.colors,
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: 'smooth'
                },
                title: {
                    text: 'Student Attendance Average',
                    align: 'left',
                    marginBottom: 20,
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                markers: {
                    size: 7
                },
                xaxis: {
                    categories: response.months,
                    title: {
                        text: 'Month'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Attendance'
                    },
                    // min : 1
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    floating: true,
                    offsetY: -25,
                    offsetX: -5
                }
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

            //END OF LINE CHART
        },
        error: function (response) {
            console.log("You must have sufficient data to show the Bar Chart");
        }
    });
}

function donut_chart_draw() {
    $.ajax({
        url: api_url + "dashboard/donut-chart",
        method: 'get',
        dataType: 'json',
        success: function (response) {
            //DONUT Chart
            var options = {
                series: response.data.returnData,
                chart: {
                    width: 550,
                    type: 'donut',
                },
                labels: response.data.label,
                plotOptions: {
                    pie: {
                        startAngle: -90,
                        endAngle: 270
                    }
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'gradient',
                },
                legend: {
                    formatter: function (val, opts) {
                        return val + " - " + opts.w.globals.series[opts.seriesIndex]
                    }
                },
                title: {
                    text: 'Last 30 days Expense'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 380
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#donut-chart"), options);
            chart.render();
            //END OF DONUT CHART
        },
        error: function (response) {
            console.log("You must have sufficient data to show the Bar Chart");
        }
    });
}

function pie_chart_draw() {
    $.ajax({
        url: api_url + "dashboard/pie-chart",
        method: 'get',
        dataType: 'json',
        success: function (response) {
            //PIE Chart
            var options = {
                series: response.data.returnData,
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: response.data.label,
                fill: {
                    type: 'gradient',
                },
                title: {
                    text: 'Last 30 days Income'
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#pie-chart"), options);
            chart.render();
            //END OF PIE CHART
        },
        error: function (response) {
            console.log("You must have sufficient data to show the Bar Chart");
        }
    });
}

function recent_activities() {
    $.ajax({
        url: api_url + "dashboard/recent",
        method: 'get',
        dataType: 'json',
        success: function (response) {
            var mainDiv = '';

            $(response.data).each(function (i, data) {
                mainDiv += `<div class="timeline-item position-relative pt-2">
                                        <div class="row">
                                            <div class="col-2 p-0 text-end">
                                                <div class="timeline-label font-weight-bold">${data.date}</div>
                                            </div>
                                            <div class="col-1 p-0 text-end">
                                                <div class="timeline-badge font-weight-bold"><i class="fa fa-dot-circle completed me-2"></i></div>
                                            </div>
                                            <div class="col-9 p-0">
                                                <div class="timeline-label px-1 w-100"><span class="fw-bold">${data.first_name}</span> Has been made <span class="${data.expense == 'expense' ? 'text-info' : 'text-success'} fw-bold">${data.expense}</span> of ${Number(data.amount) + Number(0)}</div>
                                            </div>
                                        </div>
                                    </div>`;
            });
            $('.widget-timeline').html(mainDiv);
        },
        error: function (response) {
            console.log("You must have sufficient data to show the Bar Chart");
        }
    });
}

