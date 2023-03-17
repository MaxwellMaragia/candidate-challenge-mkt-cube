<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @include('includes.messages')
                <form method="post" action="{{ route('postcards-management.store') }}">
                    {{csrf_field()}}
                    <div class="mb-3">
                        <label class="form-label">Postcard title</label>
                        <input type="text" class="form-control" name="title" required="required" value="{{ $postcard->title }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" required="required" value="{{ $postcard->price }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Online at</label>
                        <input type="datetime-local" class="form-control" name="online_at" value="{{ $postcard->online_at }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Offline at</label>
                        <input type="datetime-local" class="form-control" name="offline_at" value="{{ $postcard->offline_at }}">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="is_draft" @if($postcard->is_draft==1) checked @endif>
                        <label class="form-check-label" for="exampleCheck1">Is draft</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
