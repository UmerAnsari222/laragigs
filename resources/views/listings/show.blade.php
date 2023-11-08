<x-layout>

    <a href="/" class="inline-block text-black ml-4 mb-4 hover:text-laravel">
        <i class="fa-solid fa-arrow-left"></i>
        Back
    </a>
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mr-6 mb-6"
                    src="{{ $listings->logo ? asset('storage/' . $listings->logo) : asset('images/no-image.png') }}"
                    alt="" />

                <h3 class="text-2xl mb-2">{{ $listings->title }}</h3>
                <div class="text-xl font-bold mb-4">{{ $listings->company }}</div>

                <x-listing-tags :tagsCsv="$listings->tags" />

                <div class="text-lg my-4">
                    <i class="fa-solid fa-location-dot"></i> {{ $listings->location }}
                </div>
                <div class="border border-gray-200 w-full mb-6"></div>
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        Job Description
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{ $listings->description }}
                        </p>


                        <a href="mailto:{{ $listings->email }}"
                            class="block bg-laravel text-white mt-6 py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $listings->website }}" target="_blank"
                            class="block bg-black text-white py-2 rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </div>

        {{--
        <div class="bg-gray-50 border border-gray-200 px-4 py-2 rounded flex mt-4 gap-2">
            <a href="/listings/{{ $listings->id }}/edit">
                <i class="fa fa-pencil" aria-hidden="true"></i> Eidt
            </a>

            <form action="/listings/{{ $listings->id }}" method="POST">
                @csrf
                @method('DELETE')

                <button class="text-red-500">
                    <i class="fa fa-trash" aria-hidden="true"></i> Delete
                </button>

            </form>

        </div> --}}

    </div>
</x-layout>
