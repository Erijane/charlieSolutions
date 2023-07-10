<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (! empty($sensorLists))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-center text-gray-700 uppercase bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-12 py-6">
                                    Sensor id
                                </th>
                                <th scope="col" class="px-12 py-6">
                                    Number of appearances per day
                                </th>
                            </tr>
                            </thead>

                            @foreach($sensorLists as $date => $sensorList)
                                <thead class="text-base text-gray-700 uppercase bg-gray-40 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th  class="px-12 py-6" style="padding-left: 10px">
                                        {{ $date }}
                                    </th>
                                    <th colspan="11"></th>
                                </tr>
                                </thead>
                                @foreach($sensorList as $sensor => $nbAppearancesPerday)
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4">
                                            {{$sensor}}
                                        </th>
                                        <td class="px-6 py-4 text-center">
                                            {{$nbAppearancesPerday}}
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            @endforeach
                         </table>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @else
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            No data found
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
