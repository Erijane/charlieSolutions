<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Charlie Building site (50.6337848 ; 3.0217842)') }}
        </h2>
    </x-slot>
    @if (! empty($dataToShow))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="relative shadow-md sm:rounded-lg">
                        <div class="block mb-6 p-6 max-w bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Information</h5>
                            <div class="font-normal text-gray-700 dark:text-gray-400">
                                Here you can find some information about the Building site Charlie. For each day and different hours, you can see a tracker has detected some sensors on the building site.
                                <ul class="list-disc list-inside">
                                    <li>"Distance Tracker to Charlie Building site": this is the distance in meters between Charlie Building site and the tracker</li>
                                    <li>"Distance tracker to sensor": this is the distance in meters between the sensor and the tracker</li>
                                    <li>"Distance min": This is the minimum distance that can exist between the sensor and the Charlie Building site</li>
                                    <li>"Distance max": This is the maximum distance that can exist between the sensor and the Charlie Building site</li>
                                    <li>
                                        "In" indicates if the sensor is in the building site.
                                        <ol class="pl-5 list-disc list-inside">
                                            <li style="color: #15803d">Green: it's ok.</li>
                                            <li style="color: #a16207">Orange: the sensor may have moved out of the zone</li>
                                            <li style="color: #7f1d1d">Red: the sensor is out of the zone.</li>
                                        </ol>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="accordion" class="overflow-x-auto">
                            <?php $i=0 ?>
                            @foreach($dataToShow as $day => $infoByHours)
                                <div
                                    class="border border-t-0 border-neutral-200 bg-white dark:border-neutral-600 dark:bg-neutral-800">
                                    <h2 class="mb-0" id="{{'heading'.$i}}">
                                        <button
                                            class="group relative flex w-full items-center rounded-none border-0 bg-white px-5 py-4 text-left text-base text-neutral-800 transition [overflow-anchor:none] hover:z-[2] focus:z-[3] focus:outline-none dark:bg-neutral-800 dark:text-white [&:not([data-te-collapse-collapsed])]:bg-white [&:not([data-te-collapse-collapsed])]:text-primary [&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(229,231,235)] dark:[&:not([data-te-collapse-collapsed])]:bg-neutral-800 dark:[&:not([data-te-collapse-collapsed])]:text-primary-400 dark:[&:not([data-te-collapse-collapsed])]:[box-shadow:inset_0_-1px_0_rgba(75,85,99)]"
                                            type="button"
                                            data-te-collapse-init
                                            data-te-collapse-collapsed
                                            data-te-target="#{{'collapse'.$i}}"
                                            aria-expanded="false"
                                            aria-controls="{{'collapse'.$i}}">
                                            {{$day}}
                                            <span
                                                class="-mr-1 ml-auto h-5 w-5 shrink-0 rotate-[-180deg] fill-[#336dec] transition-transform duration-150 ease-in-out group-[[data-te-collapse-collapsed]]:mr-0 group-[[data-te-collapse-collapsed]]:rotate-0 group-[[data-te-collapse-collapsed]]:fill-[#212529] motion-reduce:transition-none dark:fill-blue-300 dark:group-[[data-te-collapse-collapsed]]:fill-white">
                                      <svg
                                          xmlns="http://www.w3.org/2000/svg"
                                          fill="none"
                                          viewBox="0 0 24 24"
                                          stroke-width="1.5"
                                          stroke="currentColor"
                                          class="h-6 w-6">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                      </svg>
                                    </span>
                                        </button>
                                    </h2>
                                    <div
                                        id="{{'collapse'.$i}}"
                                        class="!visible hidden"
                                        data-te-collapse-item
                                        aria-labelledby="{{'heading'.$i}}"
                                        data-te-parent="#accordion">
                                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                        <thead class="text-gray-700 bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-1 py-1">
                                                Hours
                                            </th>
                                            <th scope="col" class="px-1 py-1">
                                                Topic
                                            </th>
                                            <th scope="col" class="px-1 py-1">
                                                Distance Tracker to Charlie building site
                                            </th>
                                            <th scope="col" class="px-1 py-1">
                                                Sensor information
                                            </th>
                                        </tr>
                                        </thead>
                                            @foreach($infoByHours as $hours => $item)
                                                <tbody>
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <td class="px-6 py-4">
                                                        {{$hours}}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{$item['topic']}}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{$item['distanceTrackerToBuildingSite']}}
                                                    </td>
                                                    <td>
                                                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                                                            <thead class="text-gray-700 bg-gray-100 dark:bg-gray-900 dark:text-gray-400">
                                                            <tr>
                                                                <th scope="col" class="px-12 py-6">
                                                                    Id
                                                                </th>
                                                                <th scope="col" class="px-12 py-6">
                                                                    Distance tracker to sensor
                                                                </th>
                                                                <th scope="col" class="px-12 py-6">
                                                                    Distance min
                                                                </th>
                                                                <th scope="col" class="px-12 py-6">
                                                                    Distance max
                                                                </th>
                                                                <th scope="col" class="px-12 py-6">
                                                                    In
                                                                </th>
                                                            </tr>
                                                            </thead>
                                                            @foreach($item['sensors'] as $sensor => $distance)
                                                                <tbody>
                                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                                    <td class="px-6 py-4">
                                                                        {{$sensor}}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{$distance['distanceTrackerToSensor']}}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{$distance['distanceMinBetweenBuildingSiteAndSensor']}}
                                                                    </td>
                                                                    <td class="px-6 py-4">
                                                                        {{$distance['distanceMaxBetweenBuildingSiteAndSensor']}}
                                                                    </td>
                                                                    <td class="px-6 py-4" style="align-items: center">
                                                                        @if ($distance['distanceMinBetweenBuildingSiteAndSensor'] < 500 && $distance['distanceMaxBetweenBuildingSiteAndSensor'] <500)
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#15803d" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                                                            </svg>
                                                                        @elseif ($distance['distanceMinBetweenBuildingSiteAndSensor'] < 500 && $distance['distanceMaxBetweenBuildingSiteAndSensor'] > 500)
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#a16207" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.05 4.575a1.575 1.575 0 10-3.15 0v3m3.15-3v-1.5a1.575 1.575 0 013.15 0v1.5m-3.15 0l.075 5.925m3.075.75V4.575m0 0a1.575 1.575 0 013.15 0V15M6.9 7.575a1.575 1.575 0 10-3.15 0v8.175a6.75 6.75 0 006.75 6.75h2.018a5.25 5.25 0 003.712-1.538l1.732-1.732a5.25 5.25 0 001.538-3.712l.003-2.024a.668.668 0 01.198-.471 1.575 1.575 0 10-2.228-2.228 3.818 3.818 0 00-1.12 2.687M6.9 7.575V12m6.27 4.318A4.49 4.49 0 0116.35 15m.002 0h-.002" />
                                                                            </svg>
                                                                        @else
                                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#7f1d1d" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 15h2.25m8.024-9.75c.011.05.028.1.052.148.591 1.2.924 2.55.924 3.977a8.96 8.96 0 01-.999 4.125m.023-8.25c-.076-.365.183-.75.575-.75h.908c.889 0 1.713.518 1.972 1.368.339 1.11.521 2.287.521 3.507 0 1.553-.295 3.036-.831 4.398C20.613 14.547 19.833 15 19 15h-1.053c-.472 0-.745-.556-.5-.96a8.95 8.95 0 00.303-.54m.023-8.25H16.48a4.5 4.5 0 01-1.423-.23l-3.114-1.04a4.5 4.5 0 00-1.423-.23H6.504c-.618 0-1.217.247-1.605.729A11.95 11.95 0 002.25 12c0 .434.023.863.068 1.285C2.427 14.306 3.346 15 4.372 15h3.126c.618 0 .991.724.725 1.282A7.471 7.471 0 007.5 19.5a2.25 2.25 0 002.25 2.25.75.75 0 00.75-.75v-.633c0-.573.11-1.14.322-1.672.304-.76.93-1.33 1.653-1.715a9.04 9.04 0 002.86-2.4c.498-.634 1.226-1.08 2.032-1.08h.384" />
                                                                            </svg>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            @endforeach
                                                        </table>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            @endforeach
                                    </table>
                                    </div>
                                </div>
                                <?php $i++ ?>
                            @endforeach
                        </div>
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
