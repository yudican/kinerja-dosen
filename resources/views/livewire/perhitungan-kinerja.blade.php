<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>Perhitungan Kinerja</span>
                        </a>
                    </h4>
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
</div>