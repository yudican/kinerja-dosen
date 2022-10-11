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
            @if ($form_active)
            <div class="card">
                <div class="card-body row">
                    <div class="col-md-12">
                        <x-textarea type="text" name="pertanyaan" label="Pertanyaan" />

                        <div class="form-group">
                            <table width="100%" class="table table-bordered">
                                <tr>
                                    <th width="10%;">
                                        Opsi
                                    </th>
                                    <th width="70%;">
                                        Jawaban
                                    </th>
                                    <th width="20%;">
                                        Bobot Jawaban
                                    </th>
                                </tr>
                                @foreach ($inputs as $key => $value)
                                <tr>
                                    <td width="10%;">
                                        {{$key+1}}
                                    </td>
                                    <td width="70%;">
                                        <x-text-field type="text" name="jawaban_nama.{{$value}}" />
                                    </td>
                                    <td width="20%;">
                                        <x-text-field type="number" name="bobot_jawaban.{{$value}}" />
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary pull-right" wire:click="{{$update_mode ? 'update' : 'store'}}">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            @else
            @if ($question_lists && $question_lists->count() > 0)
            @foreach ($question_lists as $keys => $question)
            <div class="card">
                <div class="card-header flex flex-row justify-between items-center">
                    <h2 class="card-header-title"><b>{{$keys+1}}. {{$question->pertanyaan}}</b></h2>
                    <div class="btn-group">
                        @if (auth()->user()->hasTeamPermission($curteam, $route_name.':update') || auth()->user()->hasTeamPermission($curteam, $route_name.':delete'))
                        <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Aksi
                        </button>

                        <div class="dropdown-menu">
                            @if (auth()->user()->hasTeamPermission($curteam, $route_name.':update'))
                            <a class="dropdown-item" href="#" wire:click="getDataQuestionById({{$question->id}})">Edit</a>
                            @endif
                            @if (auth()->user()->hasTeamPermission($curteam, $route_name.':delete'))
                            <a class="dropdown-item" href="#confirm-modal" data-toggle="modal" wire:click="getQuestionId({{$question->id}})">Hapus</a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="pt-2">
                        <div class="ml-md-1 ml-sm-1 pl-md-3 pt-sm-0 pt-3" id="jawaban-{{$question->id}}">
                            <ul style="list-style-type:disc;">
                                @foreach ($question->optionQuestions as $key => $option)
                                <li>{{$option->nama_jawaban}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            @endif
        </div>

        {{-- Modal confirm --}}
        <div id="confirm-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" permission="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="my-modal-title">Konfirmasi Hapus</h5>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin hapus data ini.?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" wire:click='delete' class="btn btn-danger btn-sm"><i class="fa fa-check pr-2"></i>Ya, Hapus</button>
                        <button class="btn btn-primary btn-sm" wire:click='_reset'><i class="fa fa-times pr-2"></i>Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')



    <script>
        document.addEventListener('livewire:load', function(e) {
            window.livewire.on('loadForm', (data) => {
                
                
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
            });
        })
    </script>
    @endpush
</div>