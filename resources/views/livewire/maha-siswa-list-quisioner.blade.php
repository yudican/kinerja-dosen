<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>Data Quisioner</span>
                        </a>
                    </h4>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-12">
            @livewire('table.maha-siswa-list-quisioner-table', ['params' => [
            'quis_id' => $quis_id,
            ]])
        </div> --}}
        <div class="col-md-12">
            @foreach ($question_lists as $keys => $question)
            <div class="card">
                <div class="card-header flex flex-row justify-between items-center">
                    <h2 class="card-header-title"><b>{{$question->pertanyaan}}</b></h2>
                </div>
                <div class="card-body row">
                    <div class="col-md-8">
                        <div class="pt-2">
                            <div class="ml-md-1 ml-sm-1 pl-md-3 pt-sm-0 pt-3" id="jawaban-{{$question->id}}">
                                <ul style="list-style-type:disc;">
                                    @foreach ($question->optionQuestions as $item)
                                    <li>{{$item->nama_jawaban}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <canvas id="answers-chart-{{$question->id}}" style="height: 200px;"></canvas>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>


</div>

@push('scripts')
<script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
<script>
    document.addEventListener('livewire:load', function(e) {
            function loadChart(dataCharts=[]) {
                dataCharts.forEach(chart => {
                    var pieChart = document.getElementById('answers-chart-'+chart.id).getContext('2d')
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
                })
                
            }
            
            const dataChart = @json($chartData);
            console.log(dataChart);
            loadChart(dataChart);
        });
</script>
@endpush