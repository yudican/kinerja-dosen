<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-capitalize">
            <a href="{{route('data-perhitungan')}}">
              <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>Perhitungan Kinerja</span>
            </a>
          </h4>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <canvas id="answers-chart" style="height: 200px;"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body table-responsive">
          <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <td>Nama</td>
                @foreach ($items as $key => $item)
                @if ($key == 0)
                @foreach ($item->qustionAnswerDetails as $keys => $attribute)
                <td>A{{$keys+1}}</td>
                @endforeach
                @endif

                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $item)
              <tr>
                <td>{{ $item->dosen->nama_dosen }}</td>
                @foreach ($item->qustionAnswerDetails as $keys => $attribute)
                @if ($keys < 28) <td>@switch($attribute->optionQuestion->bobot_jawaban)
                  @case(1)
                  sangat tidak baik
                  @break
                  @case(2)
                  tidak baik
                  @break
                  @case(3)
                  cukup baik
                  @break
                  @case(4)
                  baik
                  @break
                  @case(5)
                  sangat baik
                  @break
                  @default

                  @endswitch</td>
                  @endif

                  @endforeach
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card">
        <div class="card-body  table-responsive">
          <table class="table table-light">
            <thead class="thead-light">
              <tr>
                <td>Nama</td>
                @foreach ($items as $key => $item)
                @if ($key == 0)
                @foreach ($perhitungan[$key]['atribut'] as $keys => $atribut)
                <td>A{{$keys+1}}</td>
                @endforeach
                @foreach ($perhitungan[$key]['cluster'] as $keys => $cluster)
                <td>C{{$keys+1}}</td>
                @endforeach
                <td>Jarak Terdekat</td>
                @endif
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($items as $key => $item)
              <tr>
                <td>{{ $item->dosen->nama_dosen }}</td>
                @foreach ($perhitungan[$key]['atribut'] as $atributa)
                <td>{{$atributa}}</td>
                @endforeach
                @foreach ($perhitungan[$key]['cluster'] as $clustera)
                <td>{{$clustera}}</td>
                @endforeach
                <td>{{$perhitungan[$key]['jarak']}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @push('scripts')
  <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
  <script>
    document.addEventListener('livewire:load', function(e) {
            function loadChart(chart=[]) {
                    var pieChart = document.getElementById('answers-chart').getContext('2d')
                    var myPieChart = new Chart(pieChart, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: chart.values,
                                backgroundColor :["#1d7af3","#f3545d","#fdaf4b",'#4299e1','#FE0045','#C07EF1','#67C560','#ECC94B'],
                                borderWidth: 0
                            }],
                            labels: chart.labels 
                        },
                        options : {
                            responsive: true, 
                            maintainAspectRatio: false,
                            legend: {
                                position : 'bottom',
                                labels : {
                                    fontColor: 'rgb(154, 154, 154)',
                                    fontSize: 11,
                                    usePointStyle : true,
                                    padding: 20
                                }
                            },
                            pieceLabel: {
                                render: 'percentage',
                                fontColor: 'white',
                                fontSize: 14,
                            },
                            tooltips: false,
                            layout: {
                                padding: {
                                    left: 20,
                                    right: 20,
                                    top: 20,
                                    bottom: 20
                                }
                            }
                        }
                })
                
            }
            
            const dataChart = @json($chartData);
            loadChart(dataChart);
        });
  </script>
  @endpush
</div>