@extends('layouts.layout_admin')

@section('content')
    <div class="container">
    <header class="py-4">
        <h1 class="text-center display-4">Static Page</h1>
    </header>
    <section>
        <div class="list-group">
            <a href="/admin/static_page/home" class="list-group-item list-group-item-action">หน้าหลัก</a>
            <div class="list-group-item bg-light">
                โปรเจค
            </div>
            <div class="list-group">
                <a href="/admin/static_page/project/hinspector" class="list-group-item list-group-item-action ps-5">หน้าต ตรวจบ้าน</a>
                <a href="/admin/static_page/project/hinterior" class="list-group-item list-group-item-action ps-5">หน้าต ตกแต่ง</a>
                <a href="/admin/static_page/project/hconstruction" class="list-group-item list-group-item-action ps-5">หน้าต ต่อเติม</a>
                <a href="/admin/static_page/project/hbutler" class="list-group-item list-group-item-action ps-5">หน้า Home Butler</a>
            </div>
        </div>
    </section>
</div>
@endsection
