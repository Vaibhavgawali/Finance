<div class="col-md-4 stretch-card grid-margin">
    <div class="card {{ $bgClass }} card-img-holder text-white">
      <div class="card-body">
        <img src="{{asset('admin-assets/assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image">
        <h4 class="font-weight-normal mb-3">{{ $title }}<i class="mdi {{ $icon }} mdi-24px float-right mx-2"></i>
        </h4>
         <a class="btn btn-sm {{ $btnbg }} mb-4 mt-2 text-white" href="{{ $url }}">Apply</a>
         
      </div>
    </div>
  </div>