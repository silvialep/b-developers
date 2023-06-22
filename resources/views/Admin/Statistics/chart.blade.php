@extends('layouts.admin')

@section('content')

<div class="container mt-3">
  <h1 class="pb-3">Statistiche</h1>

  <h3>Messaggi Ricevuti</h3>
  <canvas id="messagesChart" height="100px"></canvas>
  <h3>Recensioni Ricevute</h3>
  <canvas id="reviewsChart" height="100px"></canvas>

</div>


{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script type="text/javascript">
  
  // Messaggi

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

  const messagesChart = new Chart(
      document.getElementById('messagesChart'),
      config
  );



  // Recensioni

  const labelsReviews =  {{ Js::from($labelsReviews) }};
  const messagesReviews =  {{ Js::from($dataReviews) }};

  const dataReviews = {
      labels: labelsReviews,
      datasets: [{
          label: 'Recensioni per Mese/Anno',  
          backgroundColor: '#D8FA96',
          hoverBackgroundColor: '#B4F437',
          data: messagesReviews,
      }]
  };

  const configReviews = {
      type: 'bar',
      data: dataReviews,
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

  const reviewsChart = new Chart(
      document.getElementById('reviewsChart'),
      configReviews
  );


</script>

@endsection