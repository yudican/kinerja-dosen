<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>Quisioner List</span>
                        </a>
                        <div class="pull-right">
                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @foreach ($question_lists as $keys => $question)
            <div class="card">
                <div class="card-header flex flex-row justify-between items-center">
                    <h2 class="card-header-title"><b>{{$question->pertanyaan}}</b></h2>
                </div>
                <div class="card-body">
                    <div class="pt-2">
                        <div class="ml-md-1 ml-sm-1 pl-md-3 pt-sm-0 pt-3" id="jawaban-{{$question->id}}">
                            <ul style="list-style-type:disc;">
                                @foreach ($question->optionQuestions as $item)
                                @foreach ($item->questionAnswer()->where('user_id',$user_id) as $answer)
                                <li> {{$answer->nama_jawaban}}</li>
                                @endforeach
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>