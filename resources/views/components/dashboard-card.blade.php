<div class="col-md-3 stretch-card grid-margin">
    <div class="card {{ $bgClass }} card-img-holder text-white text-decoration-none">
        <a href="{{ $url }}" style="text-decoration: none;">
            <div class="card-body">
                <img src="{{ $imageUrl }}" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">{{ $title }}<i
                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>

                <h6 class="card-text mb-4 mt-2">{{ $totalCountLabel }}</h6>
                <h2>{{ $totalCount }}</h2>
            </div>
        </a>
    </div>
</div>
