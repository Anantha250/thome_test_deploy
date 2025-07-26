@extends('layouts.layout_admin')

@section('content')
    <div class="container">
        <header>
            <h1 class="text-center"> Static Page หน้า Home </h1>
        </header>
        <section>
            <div class="mb-3">
                <a href="/admin" class="text-decoration-none text-secondary"> หน้าหลัก > </a>
                <a href="/admin/static_page" class="text-decoration-none text-secondary"> static page > </a>
                <a href="/admin/static_page/home" class="text-decoration-none text-secondary"> หน้า home </a>
            </div>
            <form action="/admin/static_page/home" class="px-4 pt-3 pb-4 bg-white rounded shadow-sm" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for=""> ตรวจบ้านแล้วกี่ developer </label>
                    <input class="form-control" type="number" name="dev" value="{{ old('dev', $dev) }}">
                </div>
                <div class="form-group mb-3">
                    <label for=""> ตรวจบ้านแล้วกี่โครงการ</label>
                    <input class="form-control" type="number" name="project" value="{{ old('project', $project) }}">
                </div>
                <div class="form-group mb-3">
                    <label for=""> ตรวจบ้านแล้วกี่หลัง</label>
                    <input class="form-control" type="number" name="house" value="{{ old('house', $house) }}">
                </div>
                <div class="form-group mb-3">
                    <label for=""> ความพึงพอใจ</label>
                    <input class="form-control" type="number" name="satisfaction"
                        value="{{ old('satisfaction', $satisfaction) }}">
                </div>
                <button type="submit" class="btn btn-primary"> Submit </button>
                @if (session('status') == 'Variables updated')
                    <p class="text text-secondary mt-2">บันทึกแล้ว</p>
                @endif
            </form>
        </section>
    </div>
@endsection
