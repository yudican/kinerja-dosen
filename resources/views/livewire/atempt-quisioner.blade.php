<div class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    @foreach ($questions as $keys => $question)
                    <div class="pt-2">
                        <div class="py-2 h5"><b>{{$keys+1}}. {{$question->pertanyaan}}</b></div>
                        <div class="ml-md-1 ml-sm-1 pl-md-3 pt-sm-0 pt-3" id="jawaban-{{$question->id}}">
                            @foreach ($question->optionQuestions as $key => $option)

                            @if (isset($pilih_jawaban[$question->id]))
                            @if ($pilih_jawaban[$question->id] == $option->id)
                            <label class="mb-2">
                                <input type="checkbox" name="pilih_jawaban[]" id="pilih_jawaban-{{$question->id}}-{{$option->id}}" value="{{$option->id}}" checked disabled> <span class="checkmark"></span>
                                <span>{{$option->nama_jawaban}}</span>

                            </label> <br>

                            @else
                            <label class="mb-2">
                                <input type="checkbox" name="pilih_jawaban[]" wire:click="setUserAnswer('{{$question->id}}','{{$option->id}}')" id="pilih_jawaban-{{$question->id}}-{{$option->id}}" value="{{$option->id}}"> <span class="checkmark"></span>
                                <span>{{$option->nama_jawaban}}</span>

                            </label> <br>
                            @endif

                            @else
                            <label class="mb-2">
                                <input type="checkbox" name="pilih_jawaban[]" wire:click="setUserAnswer('{{$question->id}}','{{$option->id}}')" id="pilih_jawaban-{{$question->id}}-{{$option->id}}" value="{{$option->id}}"> <span class="checkmark"></span>
                                <span>{{$option->nama_jawaban}}</span>

                            </label> <br>
                            @endif

                            @endforeach

                        </div>
                    </div>
                    @endforeach

                    <button class="btn btn-primary mt-3" wire:click="$emit(showModal)">Kirim</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal confirm --}}
    <div id="confirm-modal" wire:ignore.self class="modal fade" tabindex="-1" permission="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
        <div class="modal-dialog" permission="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="my-modal-title">Konfirmasi simpan</h5>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin simpan data ini.?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" wire:click='store' class="btn btn-primary btn-sm"><i class="fa fa-check pr-2"></i>Ya, Simpan</button>
                    <button class="btn btn-danger btn-sm" wire:click='$emit(closeModal)'><i class="fa fa-times pr-2"></i>Batal</a>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function(e) {
            
            window.livewire.on('showModal', (data) => {
                $('#form-modal').modal('show')
            });

            window.livewire.on('closeModal', (data) => {
                $('#confirm-modal').modal('hide')
            });
        })
    </script>
    @endpush
</div>