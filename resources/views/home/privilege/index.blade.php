@extends('layouts.layout_home')

@section('content')
    <link rel="stylesheet" href="/css/home/article/index.css">
    <div class="content-box">
        <div class="content-box">

            <div class="review-page" data-aos="fade-up">
                <h1>{{ __('privilege.page-title') }}</h1>
                <p>
                    {{ __('privilege.page-description') }}
                </p>

                <!-- Categories Section -->
                <div class="search-part d-flex justify-content-center mb-3">
                    <form action="/privilege" method="GET" style="width: 60%;" class="d-flex justify-content-center gap-2">
                        <input type="search" class="form-control flex-grow-1" placeholder="{{ __('privilege.search-placeholder') }}"
                            aria-label="ค้นหาบทความ" value="{{ request()->query('search') }}" name="search" id="search"
                            style="min-width: 200px;">
                        <button type="submit" style="width: fit-content;"
                            class="form-control px-3 py-2 btn btn-outline-info">{{ __('privilege.search-button') }}</button>
                    </form>
                </div>

                <!-- Review Cards -->
                <div class="review-cards" id="review-cards">
                    @if ($privileges->isEmpty())
                        <div class="no-articles">
                            <p>{{ __('privilege.no-privileges') }}</p>
                        </div>
                    @else
                        @foreach ($privileges as $privilege)
                            <div class="new-card">
                                <a href="/privilege/detail?news_id={{ $privilege->id }}"><img
                                        src="{{ $privilege->translation->coverPageImg }}" alt="" loading="lazy"></a>
                                <a href="/privilege/detail?news_id={{ $privilege->id }}"
                                    class="new-card-title">{{ $privilege->translation->title }}</a>
                                <div>
                                    <span
                                        class="upload-date">{{ \Carbon\Carbon::parse($privilege->created_at)->locale(app()->getlocale())->isoFormat('D-MM-YYYY') }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                {{ $privileges->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.all').addEventListener('click', function(event) {
            event.preventDefault();
            localtion.href = '/privilege';
        });
    </script>
@endsection
