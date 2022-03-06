var gaugeOptions = {
    chart: {
      type: 'solidgauge'
    },
  
    title: null,
  
    pane: {
      center: ['50%', '85%'],
      size: '140%',
      startAngle: -90,
      endAngle: 90,
      background: {
        backgroundColor:
          Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
        innerRadius: '60%',
        outerRadius: '100%',
        shape: 'arc'
      }
    },
  
    exporting: {
      enabled: false
    },
  
    tooltip: {
      enabled: false
    },
  
    // the value axis
    yAxis: {
      stops: [
        [0.1, '#DDDF0D'], // yellow
        [0.5, '#55BF3B'], // green
        [0.9, '#DF5353'] // red
      ],
      lineWidth: 0,
      tickWidth: 0,
      minorTickInterval: null,
      tickAmount: 2,
      title: {
        y: -70
      },
      labels: {
        y: 16
      }
    },
  
    plotOptions: {
      solidgauge: {
        dataLabels: {
          y: 5,
          borderWidth: 0,
          useHTML: true
        }
      }
    }
  };
  
  // The speed gauge
  var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 200,
      title: {
        text: 'Temperatura Máxima Histórica'
      }
    },
  
    credits: {
      enabled: false
    },
  
    series: [{
      name: 'Temperatura Máxima',
      data: [tempMax],
      dataLabels: {
        format:
          '<div style="text-align:center">' +
          '<span style="font-size:25px">{y}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4"> C</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: ' C'
      }
    }]
  
  }));
  
  // The RPM gauge
  var chartRpm = Highcharts.chart('container-rpm', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 100,
      title: {
        text: 'Humedad Maxima historica'
      }
    },

    credits: {
        enabled: false
      },
  
    series: [{
      name: 'Humedad Maxima',
      data: [humMax],
      dataLabels: {
        format:
          '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">' +
          ' %' +
          '</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  
  }));

  var chartTempMin = Highcharts.chart('container-tempMin', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 100,
      title: {
        text: 'Temperatura Mínima Histórica'
      }
    },
    credits: {
        enabled: false
      },
  
    series: [{
      name: 'Temperatura Mínima Histórica',
      data: [tempMin],
      dataLabels: {
        format:
          '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">' +
          ' C' +
          '</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: ' C'
      }
    }]
  
  }));

  var chartHumMin = Highcharts.chart('container-humMin', Highcharts.merge(gaugeOptions, {
    yAxis: {
      min: 0,
      max: 100,
      title: {
        text: 'Humedad Mínima Histórica'
      }
    },
  
    series: [{
      name: 'Humedad Mínima Histórica',
      data: [humMin],
      dataLabels: {
        format:
          '<div style="text-align:center">' +
          '<span style="font-size:25px">{y:.1f}</span><br/>' +
          '<span style="font-size:12px;opacity:0.4">' +
          ' %' +
          '</span>' +
          '</div>'
      },
      tooltip: {
        valueSuffix: ' %'
      }
    }]
  
  }));
