@extends('index')

@section('slider')

    @foreach ($sliders as $item)
        <div>
            <a class="eskimo-slider-img" href="blog/text?id={{ $item->sliderTextID }}"></a>
            <ul class="eskimo-slider-image-meta eskimo-image-meta-post">
                <li><a href="blog/text?id={{ $item->sliderTextID }}">
                        <span class="badge badge-default">{{ date('d/m/Y', strtotime($item->created_at)) }}</span></a>
                </li>

                <li>
                    <a href="category.html">
                        <span class="badge badge-default">
                            @foreach ($categories as $category)
                                @if ($item->sliderCategory == $category->id)
                                    {{ $category->categoryName }}
                                @endif
                            @endforeach
                        </span>
                    </a>
                </li>
            </ul>
            <div class="clearfix"></div>
            <img class="sliderImage" src="assets/images/sliders/{{ $item->sliderPictureName }}"
                alt="{{ $item->sliderContent }}" />
            <div class="eskimo-slider-desc">
                <div class="eskimo-slider-desc-inner">
                    <h2 class="card-title">{{ $item->sliderTitle }}</h2>
                    <p>{{ $item->sliderContent }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('texts')

    @foreach ($texts as $item)
        <div class="card card-horizontal">
            <div class="card-body">
                <div class="card-horizontal-left">
                    <div class="card-category">
                        @foreach ($categories as $category)
                            @if ($item->textCategory == $category->id)

                                <a href="category.html">{{ $category->categoryName }}</a>
                            @endif
                        @endforeach
                    </div>
                    <h3 class="card-title"><a href="{{ $item->id }}">{{ $item->textTitle }}</a></h3>
                    <div class="card-excerpt">
                        <p>
                            {{ 
                                Str::length($item->text) > 150 ? Str::substr($item->text, 0, 150). "..." : $item->text
                            }}
                        </p>
                    </div>
                    <div class="card-horizontal-meta">
                        <div class="eskimo-author-meta">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            {{ $item->textHowManySeen }}
                            Times Readed
                        </div>
                        <div class="eskimo-date-meta">
                            <i class="fa fa-calendar" aria-hidden="true"></i>
                            <a href="{{ $item->id }}">{{ date('d/m/Y', strtotime($item->created_at)) }}</a>
                        </div>

                        <div class="eskimo-reading-meta">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            {{ readingTime($item->text) }} Reading Time
                        </div>
                    </div>
                </div>
                <div class="card-horizontal-right" data-img="assets/images/{{ $item->textPicture }}">
                    <a class="card-featured-img" href="{{ $item->id }}"></a>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('popularTexts')
    @foreach ($popularTexts as $popular)
        <div>
            <div class="card-masonry card-small">
                <div class="card">
                    <a href="{{ $popular->id }}">
                        <img class="card-vertical-img" src="assets/images/{{ $popular->textPicture }}"
                            alt="{{ $popular->textTitle }}" />
                    </a>
                    <div class="card-border">
                        <div class="card-body">
                            <div class="card-category">
                                <a href="{{ $popular->id }}">{{ date('F j, Y', strtotime($popular->created_at)) }}</a>
                            </div>
                            <h5 class="card-title"><a href="{{ $popular->id }}">{{ $popular->textTitle }}</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('menu')

    <div id="eskimo-sidebar-cell" class="w-100">
        <!-- MOBILE MENU BUTTON -->
        <div id="eskimo-menu-toggle">MENU</div>
        <!-- MENU -->
        <nav id="eskimo-main-menu" class="menu-main-menu-container">
            <ul class="eskimo-menu-ul">
                @foreach ($menu as $item)
                    <li><a href="{{ $item->menuLink }}">{{ $item->menuContent }}</a></li>
                @endforeach
            </ul>
        </nav>
    </div>
@endsection


@section('socialMedia')
    <div id="eskimo-social-cell" class="mt-auto w-100">
        <div id="eskimo-social-inner">
            <ul class="eskimo-social-icons">
                @foreach ($socialMedia as $item)
                    <li>
                        <a href="{{ $item->socialMediaLink }}">
                            <i class="{{ $item->socialMediaIcon }}"></i>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
