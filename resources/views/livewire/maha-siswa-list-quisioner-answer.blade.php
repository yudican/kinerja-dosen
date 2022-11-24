<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-capitalize">
                        <a href="{{route('dashboard')}}">
                            <span><i class="fas fa-arrow-left mr-3"></i>Master Pertanyaan</span>
                        </a>
                        <div class="pull-right">
                            @if ($form_active)
                            <button class="btn btn-danger btn-sm" wire:click="toggleForm(false)"><i class="fas fa-times"></i> Cancel</button>
                            @else
                            @if (auth()->user()->hasTeamPermission($curteam, $route_name.':create'))
                            <button class="btn btn-primary btn-sm" wire:click="{{$modal ? 'showModal' : 'toggleForm(true)'}}"><i class="fas fa-plus"></i> Add New</button>
                            @endif
                            @endif
                        </div>
                    </h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @foreach ($question_lists as $keys => $question)
            <div class="card">
                <div class="card-header flex flex-row justify-between items-center">
                    <h2 class="card-header-title"><b>Jawaban Pertanyaan</b></h2>
                </div>
                <div class="card-body">
                    <div class="pt-2">
                        <div class="ml-md-1 ml-sm-1 pl-md-3 pt-sm-0 pt-3" id="jawaban-{{$question->id}}">
                            <ul style="list-style-type:disc;">
                                <li>{{$question->answer_jawaban}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>