    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header align-middle mb-5">
                    <h1 class="card-title">Hello {{ $name }}</h1>
                </div>
                <div class="card-body">
                    <div class="typography-line">
                        <span>
                            <hr>
                            <h3>English title : </h3>
                        </span>
                        <h5 class="text-primary">
                            {{ $newsletter->getTranslation('title', 'en') }}</h5>
                    </div>
                    <div class="typography-line">
                        <span>
                            <h3>Arabic title : </h3>
                        </span>
                        <h5 class="text-primary">
                            {{ $newsletter->getTranslation('title', 'ar') }}</h5>
                    </div>
                    <hr>
                    <div class="typography-line">
                        <span>
                            <h3> English content : </h3>
                        </span>
                        <h5 class="text-primary">
                            {{ $newsletter->getTranslation('content', 'en') }}</h5>
                    </div>
                    <div class="typography-line">
                        <span>
                            <h3> Arabic content: </h3>
                        </span>
                        <h5 class="text-primary">
                            {{ $newsletter->getTranslation('content', 'ar') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($newsletter->getMedia('images') as $mediaItem)
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img" src="{{ $mediaItem->getUrl() }}" / width="500px"
                            alt="newsletter image">
                        <br>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
