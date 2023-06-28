@extends('layouts.admin')

@section('content')

<div class="container my-4 mb-5">
  <h1 class="pb-3">Statistiche</h1>

  <h3>Messaggi Ricevuti</h3>
  <canvas id="messagesChart"></canvas>
  <h3 class="mt-5">Recensioni Ricevute</h3>
  <canvas id="reviewsChart"></canvas>
</div>

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
      options: {
        scales: {
            y: {
                suggestedMin: 1,
                suggestedMax: 10
            }
        },
        plugins: {
          legend: {
            display: false
          }
        }
      },
  };

  const messagesChart = new Chart(
      document.getElementById('messagesChart'),
      config
  );

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
      options: {
        scales: {
            y: {
                suggestedMin: 1,
                suggestedMax: 10
            }
        },
        plugins: {
          legend: {
            display: false
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