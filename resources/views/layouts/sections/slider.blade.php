<section>
    <div class="owl-carousel owl-theme slider">
        @foreach ($slider->images as $image)
            <div class="item" style="background-image: url('{{ asset($image->getPath()) }}')">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <div class="owl-text">
                                <div class="sub">
                                    {{ $image->sub }}
                                </div>
                                <div class="name">{{ $image->name }}</div>
                                <div class="desc">{{ $image->desc }}</div>
                                <a class="btn" href="{{ $image->link }}">
                                    Подробнее
                                    {{ svg('arrow') }}
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="owl-dots">
                                @for ($i = 0,$iMax = count($slider->images); $i < $iMax; $i++)
                                    <button role="button" class="owl-dot{{ $i === $loop->index ? ' active' : '' }}">
                                        <span>0{{ $i + 1 }}</span>
                                    </button>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
