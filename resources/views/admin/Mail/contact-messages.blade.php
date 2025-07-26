@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Contact Messages</h1>
        <p class="text-gray-600">Manage and respond to customer inquiries</p>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row gap-4 mb-6">
        <form method="GET" class="flex gap-4 w-full">
            <select name="status" class="border rounded px-3 py-2">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>All Statuses</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
                <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Replied</option>
                <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
            
            <select name="subject" class="border rounded px-3 py-2">
                <option value="all" {{ request('subject') == 'all' ? 'selected' : '' }}>All Subjects</option>
                <option value="general" {{ request('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                <option value="service" {{ request('subject') == 'service' ? 'selected' : '' }}>Service Inquiry</option>
                <option value="quote" {{ request('subject') == 'quote' ? 'selected' : '' }}>Quote Request</option>
                <option value="partnership" {{ request('subject') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                <option value="other" {{ request('subject') == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Filter
            </button>
        </form>
    </div>

    <!-- Messages Grid -->
    <div class="grid gap-6">
        @forelse($messages as $message)
            <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">{{ $message->name }}</h3>
                        <p class="text-gray-600">{{ $message->subject_display }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2">
                        <span class="px-3 py-1 rounded-full text-sm {{ $message->status_color }}">
                            {{ ucfirst($message->status) }}
                        </span>
                        <span class="text-sm text-gray-500">
                            {{ $message->created_at->format('d/m/Y H:i') }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-envelope text-gray-500"></i>
                        <span class="text-sm">{{ $message->email }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-phone text-gray-500"></i>
                        <span class="text-sm">{{ $message->phone }}</span>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-gray-600 text-sm line-clamp-2">{{ Str::limit($message->message, 150) }}</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('admin.contact.show', $message->id) }}" 
                       class="flex-1 bg-blue-600 text-white text-center py-2 px-4 rounded hover:bg-blue-700 transition-colors">
                        <i class="fas fa-eye mr-2"></i>View Details
                    </a>
                    
                    <form method="POST" action="{{ route('admin.contact.update-status', $message->id) }}" class="flex-1">
                        @csrf
                        @method('PATCH')
                        <select name="status" onchange="this.form.submit()" 
                                class="w-full border rounded px-3 py-2">
                            <option value="new" {{ $message->status == 'new' ? 'selected' : '' }}>New</option>
                            <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                            <option value="closed" {{ $message->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </form>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <p class="text-gray-600">No messages found.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $messages->links() }}
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
