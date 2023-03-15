<x-guest-layout>

    <div class="min-h-full">
        <!-- Navbar -->
        <nav class="bg-gray-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative flex h-16 items-center justify-between border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <img class="h-8 w-auto" src="https://www.ringier.com/wp-content/themes/ringiercorporate/assets/images/ringier-logo.svg" alt="Ringier Logo">
                        </div>

                    </div>

                </div>
            </div>
        </nav>

        <!-- Page heading -->
        <header class="bg-gray-50 py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 xl:flex xl:items-center xl:justify-between">
                <div class="min-w-0 flex-1">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol role="list" class="flex items-center space-x-4">
                            <li>
                                <div>
                                    <a href="#" class="text-sm font-medium text-gray-500 hover:text-gray-700">Home</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                    <h1 class="mt-2 text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Postcards index</h1>
                </div>

            </div>
        </header>

        <main class="pt-8 pb-16">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <form class="group relative" action="{{ route('search') }}" method="GET">
                    <input class="focus:ring-2 focus:ring-blue-500 focus:outline-none appearance-none w-full text-sm leading-6 text-slate-900 placeholder-slate-400 rounded-md py-2 pl-10 ring-1 ring-slate-200 shadow-sm" type="text" aria-label="Filter postcards" placeholder="Search postcards..." name="search" required>
                    <button type="submit">Search</button>
                </form>
                <ul role="list" class="mt-5 divide-y divide-gray-200 border-t border-gray-200 sm:mt-0 sm:border-t-0">
                    @forelse ($postcards as $postcard)
                        <li>
                            <a href="{{ route('postcards.show', $postcard) }}" class="group block">
                                <div class="flex items-center py-5 px-4 sm:py-6 sm:px-0">
                                    <div class="flex min-w-0 flex-1 items-center">

                                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-3 md:gap-2">
                                            <div>
                                                <img src="https://picsum.photos/220/150?random={{ $postcard->id }}" alt="{{ $postcard->title }}">
                                            </div>
                                            <div>
                                                <p class="truncate text-sm font-medium">{{ $postcard->title }}</p>
                                                <p class="mt-2 flex items-center text-sm text-gray-500">
                                                    <span class="truncate">{{ $postcard->user->name }}</span>
                                                </p>
                                            </div>
                                            <div class="hidden md:block">
                                                <div>
                                                    <p class="text-sm text-gray-900">
                                                        R{{ $postcard->price }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-700" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <p>No postcards found with keyword</p>
                    @endforelse
                </ul>

                <!-- Pagination -->
                <nav aria-label="Pagination">
                    {{ $postcards->links() }}
                </nav>
            </div>
        </main>
    </div>

</x-guest-layout>
