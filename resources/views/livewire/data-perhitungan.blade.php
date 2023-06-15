<div class="page-inner">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-capitalize">
            <a href="{{route('dashboard')}}">
              <span><i class="fas fa-arrow-left mr-3 text-capitalize"></i>data perhitungan</span>
            </a>

          </h4>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="form-group">
            <label for="my-input">Pilih Semester</label>
            <select wire:model="data_semester_id" class="form-control" wire:change="selectSemester($event.target.value)">
              <option value="">Pilih Semester</option>
              @foreach ($semesters as $semester)
              <option value="{{$semester->id}}">{{$semester->kode_semester}} -
                {{$semester->nama_semester}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <livewire:table.data-jadwal-table params="{{$route_name}}" sort="hari_jadwal|asc" />
    </div>
  </div>
</div>