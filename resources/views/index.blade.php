<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')

    <title>CSV Processor</title>
</head>

<body>
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen  bg-center bg-white  ">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">


            <div class="shadow px-4 py-3 mb-3 ">

                <h1 class="text-4xl"> Upload CSV file to process </h1>
                @error('csvFile')
                    <span class="text-red-400"> {{ $message }}</span>
                @enderror
                <form action="{{ route('importCsv') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="px-4 py-5 space-y-6 sm:p-6">

                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="button"
                                class=" flex  ml-5 bg-white py-2 px-3 border border-gray-300 rounded-md shadow-md  ">
                                <input type="file" name="csvFile"
                                    class="absolute left-0 top-0 right-0 bottom-0 opacity-0 cursor-pointer" />
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m3.75 9v6m3-3H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                </svg>
                                <span class="pt-1 pl-2">Add CSV file</span>
                            </button>
                        </div>

                        <div class="px-4 py-3 text-right sm:px-6">
                            <button type="submit"
                                class="relative overflow-hidden ml-5 bg-teal-600
                                text-white py-2 px-3 border border-gray-300 rounded-md shadow-md text-sm leading-4 font-medium
                                hover:bg-teal-700     ">
                                Upload
                            </button>
                        </div>

                    </div>

                </form>

            </div>
            @if (!empty($people))
                <div class="flex min-h-screen items-center justify-center">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white shadow-md rounded-xl">
                            <thead>
                                <tr class="bg-blue-gray-100 text-gray-700">
                                    <th class="py-3 px-4 text-left">Title</th>
                                    <th class="py-3 px-4 text-left">First name</th>
                                    <th class="py-3 px-4 text-left">Initial</th>
                                    <th class="py-3 px-4 text-left">Last name</th>
                                </tr>
                            </thead>
                            <tbody class="text-blue-gray-900">

                                @foreach ($people as $key => $item)
                                    <tr class="border-b border-blue-gray-200">
                                        <td class="py-3 px-4"> {{ $item['title'] }} </td>
                                        <td class="py-3 px-4"> {{ $item['first_name'] }} </td>
                                        <td class="py-3 px-4"> {{ $item['initial'] }} </td>
                                        <td class="py-3 px-4"> {{ $item['last_name'] }} </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</body>

</html>
