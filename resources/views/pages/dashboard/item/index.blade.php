<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Movie &raquo; {{ $movie->title }} &raquo; Detail
        </h2>

    </x-slot>

    <x-slot name="script">
        <script>
            // AJAX DataTable
            var datatable = $('#crudTable').DataTable({
                devug: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                        width: '5%'
                    },
                    {
                        data: 'url',
                        name: 'url'

                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%'
                    },
                ],
            });
        </script>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg mb-10">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex mb-5">
                        <div class="flex-none">
                            <img style="max-width: 200px; object-fit: contain"
                                src="{{ Storage::url($movie->url_poster) }}" alt="Poster {{ $movie->title }}"
                                class="w-32">
                        </div>
                        <div class="flex-grow ml-2">
                            <table class="table-auto w-full ml-4">
                                <tbody>
                                    <tr>
                                        <th class="border px-6 py-4 text-left">Judul</th>
                                        <td class="border px-6 py-4">{{ $movie->title }}</td>
                                    </tr>
                                    <tr>
                                        <th class="border px-6 py-4 text-left">Genre</th>
                                        <td class="border px-6 py-4">{{ $movie->genre->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="border px-6 py-4 text-left">Tahun Rilis</th>
                                        <td class="border px-6 py-4">{{ $movie->release_year }}</td>
                                    </tr>
                                    <tr>
                                        <th class="border px-6 py-4 text-left">Durasi</th>
                                        <td class="border px-6 py-4">{{ $movie->duration }} menit</td>
                                    </tr>
                                    <tr>
                                        <th class="border px-6 py-4 text-left">Deskripsi</th>
                                        <td class="border px-6 py-4">{{ $movie->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="mb-10">
                <a href=""
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Add Video
                </a>
            </div>
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <table id="crudTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Video</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
