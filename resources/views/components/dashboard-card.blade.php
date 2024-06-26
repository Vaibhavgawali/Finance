<div class="col-md-4 stretch-card grid-margin">
    <div class="card {{ $bgClass }} card-img-holder text-white text-decoration-none">

        <div class="card-body">
            <a href="{{ $url }}" class="text-white text-decoration-none">
                <img src="{{ $imageUrl }}" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">{{ $title }}<i
                        class="mdi {{ $icon }} mdi-24px float-right mx-2"></i>
                </h4>
                @if ($url !== '/insurance')
                    <a class="btn btn-sm {{ $btnbg }} mb-4 mt-2 text-white" href="{{ $applyUrl }}">Apply</a>
                @endif
                <h6 class="card-text mb-4 mt-2">{{ $totalCountLabel }}</h6>
                <h2>{{ $totalCount }}</h2>
            </a>
        </div>

    </div>
</div>
