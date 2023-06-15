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

    </div>
    <div class="col-md-12">
      <livewire:table.data-jadwal-table params="{{$route_name}}" sort="hari_jadwal|asc" />
    </div>
  </div>
</div>