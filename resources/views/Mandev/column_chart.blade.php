

@foreach ($chartData['data'] as $key=>$value)
  var chart_column{{ $chartData['chart_number'][$key] }} = new CanvasJS.Chart("chart_column{{ $chartData['chart_number'][$key] }}",
  {
  theme: "theme2",
  title: {
  text: "{!! $chartData['text'][$key] !!}"
  },
  data: [
  {
  type: "column",
  dataPoints: [
  {!! $value !!}

  ]
  }
  ]
  });

  chart_column{{ $chartData['chart_number'][$key] }}.render();
@endforeach