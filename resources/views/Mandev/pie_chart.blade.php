

@foreach ($chartData['data'] as $key=>$value)

  var chart_pie{{ $chartData['chart_number'][$key] }} = new CanvasJS.Chart("chart_pie{{ $chartData['chart_number'][$key] }}",
  {
  title:{
  text: "{!! $chartData['text'][$key] !!}"
  },
  animationEnabled: true,
  legend:{
  verticalAlign: "center",
  horizontalAlign: "left",
  fontSize: 20,
  fontFamily: "Helvetica"
  },
  theme: "theme2",
  data: [
  {
  type: "pie",
  indexLabelFontFamily: "Garamond",
  indexLabelFontSize: 20,
  indexLabel: "{label} {y}{!! $chartData['type'][$key] !!}",
  startAngle:-20,
  showInLegend: true,
  toolTipContent:"{legendText} {y}{!! $chartData['type'][$key] !!}",
  dataPoints: [
  {!! $value !!}
  ]
  }
  ]
  });
  chart_pie{{ $chartData['chart_number'][$key] }}.render();
@endforeach