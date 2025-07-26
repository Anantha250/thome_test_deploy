{{-- filepath: c:\xampp\htdocs\example-app\resources\views\home\review_home\index.blade.php --}}
@extends('layouts.layout_home')

@section('content')
    <link rel="stylesheet" href="/css/home/review_home/index.css">

    <!-- Main Content -->
    <div class="review-page" data-aos="fade-up">
        <h1>{{ __('review_home.page-title') }}</h1>
        <p>
            {{ __('review_home.page-description') }}
        </p>

        <!-- Categories Section -->
        <div class="search-part d-flex justify-content-center mb-3">
            <form action="/review" method="GET" style="width: 60%;" class="d-flex justify-content-center gap-2">
                <input type="search" class="form-control flex-grow-1" placeholder="{{ __('review_home.search-placeholder') }}" aria-label="{{ __('review_home.search-placeholder') }}"
                    value="{{ request()->query('search') }}" name="search" id="search" style="min-width: 200px;">
                <button type="submit" style="width: fit-content;"
                    class="form-control px-3 py-2 btn btn-outline-info">{{ __('review_home.search-button') }}</button>
            </form>
        </div>

        <div class="categories mb-3" data-aos="fade-up" data-aos-duration="1500">
            @if (request()->query('project') == '' || request()->query('project') == null)
                <a class="category-btn active all" href="#">{{ __('review_home.category-all') }}</a>
            @else
                <a class="category-btn" href="/review">{{ __('review_home.category-all') }}</a>
            @endif

            @foreach ($projects as $project)
                @if (request()->query('project') == $project->translation)
                    <a class="category-btn active"
                        href="?project={{ $project->translation }}">{{ $project->translation }}</a>
                @else
                    <a class="category-btn" href="?project={{ $project->translation }}">{{ $project->translation }}</a>
                @endif
            @endforeach
        </div>

        <!-- Review Cards -->
        <div class="review-cards">
            @if ($houses->isEmpty())
                <div class="no-articles">
                    <p>{{ __('review_home.no-reviews') }}</p>
                </div>
            @else
                @foreach ($houses as $house)
                    <a href="/review/detail?news_id={{ $house->id }}" class="card new-card"
                        data-category="{{ $house->project }}">
                        <img src="{{ $house->translation->coverPageImg }}" alt="{{ $house->translation->title }}">
                        <p>{{ $house->translation->title }}</p>
                    </a>
                @endforeach
            @endif
        </div>
        {{ $houses->links('vendor.pagination.default') }}
    </div>
@endsection
