@extends('layouts.layout_admin')

@section('content')
    <style>
        button {
            background: black;
            color: white;
            border-radius: 5px;
            padding: 10px 20px;
            margin-top: 10px;
        }

        input {
            max-width: 400px;
            margin-bottom: 10px;
        }
    </style>

    <div class="container">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('admin.profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('admin.profile.partials.update-password-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
