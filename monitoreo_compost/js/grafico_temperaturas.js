Highcharts.chart('container', {
    chart: {
        type: 'spline'
    },
    title: {
        text: 'Temperatura vs tiempo'
    },
    subtitle: {
        text: ' '
    },
    xAxis: {
        type: 'datetime',
        dateTimeLabelFormats: { // don't display the dummy year
           
            month: '%e. %b',
            year: '%b'
        },
        title: {
            text: 'Fecha'
        }
    },
    yAxis: {
        title: {
            text: 'Temperatura (°C)'
        },
        min: null
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br>',
        pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
    },

    plotOptions: {
        series: {
            marker: {
                enabled: true
            }
        }
    },

    colors: ['#6CF', '#39F', '#06C', '#036', '#000'],

    // Define the data points. All series have a dummy year
    // of 1970/71 in order to be compared on the same x axis. Note
    // that in JavaScript, months start at 0 for January, 1 for February etc.
    series: [{
        name: "Winter 2014-2015",
        data: [ temperaturas
        ]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                plotOptions: {
                    series: {
                        marker: {
                            radius: 2.5
                        }
                    }
                }
            }
        }]
    }
});