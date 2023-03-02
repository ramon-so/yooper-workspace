@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper - Contratos')
@section('pagina', 'RELATÓRIO NET')

@section('conteudo')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.
function drawChart() {

  // Create the data table.
  var data = new google.visualization.DataTable();
  data.addColumn('string', 'Topping');
  data.addColumn('number', 'Slices');
  data.addRows([
    ['Contratos ativos', 3],
    ['Contratos Canceldos', 1]
  ]);

  // Set chart options
  var options = {'title':'Ativos x Cancelados',
                 'width':400,
                 'height':300};

  // Instantiate and draw our chart, passing in some options.
  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
  chart.draw(data, options);
}
</script>
@include('layouts.gestao.partials.widgets-relatorio-net')
<!--Div that will hold the pie chart-->
<div id="chart_div"></div>
@endsection