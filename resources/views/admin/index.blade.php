@extends('layouts.layout_admin')

@section('content')
    <div class="container">
        {{ $translation['title'] }}
    </div>
    {{-- <img src="/storage/1Wdly9ELxVF3NtyIsVicTDRkTp0ClwriQ2imGkZ5.png" alt=""> --}}
    <div>
        <input type="file" id="thai-cover" accept="image/*" class="articleCoverImage thai form-control" required>
        <button id="submit">submit</button>
    </div>

    <script>
        // document.getElementById('submit').addEventListener('click', async (e) => {
        //     await fetch('/admin').then((response) => {
        //         return response.text();
        //     }).then((data) => {
        //         console.log(data);
        //     }).catch((error) => {
        //         console.error('Error:', error);
        //     });
        // });
        document.getElementById('submit').addEventListener('click', async () => {
            const formData = new FormData();
            formData.append("image", document.getElementById('thai-cover').files[0])

            const response = await fetch("/admin/upload_image", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            const data = await response.text()
            console.log(data);
        })
    </script>
@endsection
