$(document).ready(function () {
  var forth_color = "transparent";
  var text_color = $("p").css("color");

  google.charts.load("current", { packages: ["bar", "corechart"] });

  google.charts.setOnLoadCallback(drawCharts);

  options = {
    titleTextStyle: {
      color: text_color,
      fontSize: 20,
      bold: true,
    },
    backgroundColor: forth_color,
    colors: ["red"],
    bar: { groupWidth: "61.8%", color: "red" },
    legend: { position: "none" },
    annotations: {
      textStyle: {
        color: text_color,
        fontSize: 15,
      },
    },
    dataOpacity: 0.8,
    hAxis: {
      title: "Clientes",
      baseline: 0,
      baselineColor: "red",
      gridlines: {
        color: "#FFFFFF55",
        count: 5,
      },
      minorGridlines: {
        count: 0,
      },
      titleTextStyle: {
        color: text_color,
        fontSize: 15,
        italic: true,
      },
      textStyle: {
        color: text_color,
        fontSize: 15,
      },
    },
    vAxis: {
      textStyle: {
        color: text_color,
        fontSize: 15,
      },
    },
  };

  function drawCharts() {
    drawChart();
    drawChartSped();
  }

  function getData() {
    var jsonData = $.ajax({
      type: "POST",
      url: DEFAULT_URL + "/Relatorio/getChart",
      data: "jsonRequired",
      dataType: "JSON",
      async: false,
    });

    return [jsonData.responseText, jsonData.responseJSON];
  }

  function getDataSped() {
    var jsonData = $.ajax({
      type: "POST",
      url: DEFAULT_URL + "/Relatorio/getChartSped",
      data: "jsonRequired",
      dataType: "JSON",
      async: false,
    });

    return [jsonData.responseText, jsonData.responseJSON];
  }

  function drawChart() {
    var Data = getData();
    console.log(Data);
    var jsonData = Data[1];
    var name = jsonData.name;

    var data = new google.visualization.DataTable(jsonData);

    var chart = new google.visualization.BarChart(
      document.getElementById("chartCounters2")
    );

    var view = new google.visualization.DataView(data);
    view.setColumns([
      0,
      1,
      {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation",
      },
    ]);

    options.title = name;

    chart.draw(view, options);
  }

  function drawChartSped() {
    var Data = getDataSped();
    console.log(Data);
    var jsonData = Data[1];
    var name = Data[1].name;

    var data = new google.visualization.DataTable(jsonData);

    var chart = new google.visualization.BarChart(
      document.getElementById("chartCounters")
    );

    var view = new google.visualization.DataView(data);
    view.setColumns([
      0,
      1,
      {
        calc: "stringify",
        sourceColumn: 1,
        type: "string",
        role: "annotation",
      },
    ]);

    options.title = name;

    chart.draw(view, options);
  }

  $(window).resize(function () {
    drawCharts();
  });
});
