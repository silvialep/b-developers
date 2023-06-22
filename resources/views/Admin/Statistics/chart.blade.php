@extends('layouts.admin')

@section('content')

<div class="container mt-3">
  <h1>Statistiche</h1>

  <canvas id="myChart" height="100px"></canvas>
</div>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
  
  const labels =  {{ Js::from($labels) }};
  const messages =  {{ Js::from($data) }};

  const data = {
      labels: labels,
      datasets: [{
          label: 'Messaggi per Mese/Anno',  
          backgroundColor: '#9ACFF5',
          hoverBackgroundColor: '#3EA2ED',
          data: messages,
      }]
  };

  const config = {
      type: 'bar',
      data: data,
      // options: {}
      options: {
        scales: {
            y: {
                suggestedMin: 1,
                suggestedMax: 10  
            }
        }
      },
  };

  const myChart = new Chart(
      document.getElementById('myChart'),
      config
  );

</script>

@endsection