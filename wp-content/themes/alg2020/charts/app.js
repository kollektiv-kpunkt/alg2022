(function () {
  var options = {
    chart: { type: "pie", options3d: { enabled: true, alpha: 45 } },
    title: { text: "Einnahmen" },
    subtitle: { text: "CHF 110'000" },
    plotOptions: {
      pie: { innerSize: 100, depth: 45 },
      series: { animation: false, dataLabels: {} },
    },
    series: [{ name: "CHF", turboThreshold: 0, marker: {} }],
    // data: [{
    //         "Ortsgruppe": "Kanton",
    //         "CHF" : 5000
    //     }, {
    //         "Ortsgruppe": "Kanton",
    //         "CHF": 5000
    //     }, {
    //         "Ortsgruppe": "Kanton",
    //         "CHF": 5000
    //     },
    // ],
    data: {
      csv: '"Einnahme";"CHF"\n"Unterstützung Grüne Schweiz";16000\n"Spenden";8000\n"Kostenanteil Ortsgruppierungen";50000\n"Sponsorenlauf";12000\n"Rückstellungen";15000\n"Fraktionsbeitrag";7000\n"Delegiertenversammlung";2000\n',
    },
    yAxis: [{ title: { text: "CHF" }, labels: {} }],
    xAxis: [{ title: { text: "CHF" }, labels: { format: "{value}" } }],
    legend: {},
    tooltip: {},
  };
  /*
        // Sample of extending options:
        Highcharts.merge(true, options, {
            chart: {
                backgroundColor: "#bada55"
            },
            plotOptions: {
                series: {
                    cursor: "pointer",
                    events: {
                        click: function(event) {
                            alert(this.name + " clicked\n" +
                                "Alt: " + event.altKey + "\n" +
                                "Control: " + event.ctrlKey + "\n" +
                                "Shift: " + event.shiftKey + "\n");
                        }
                    }
                }
            }
        });
        */
  new Highcharts.Chart(
    "highcharts-dfe93eef-3b9c-4f85-bbed-dae1d2fd23a7",
    options
  );
})();
