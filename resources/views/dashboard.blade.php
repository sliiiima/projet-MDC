@extends('layout.app')
@section('mini title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <!-- Total Patients Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Patients</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ \App\Models\Patient::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Medications Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Medications</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ \App\Models\Medicament::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Prescriptions Card -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Prescriptions</dt>
                            <dd class="text-lg font-semibold text-gray-900">{{ \App\Models\Ordonnance::count() }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-5">
        <table class="min-w-full table-auto border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th colspan="3" class="px-6 py-4 text-xl font-semibold text-center text-white bg-green-500">medicament
                        ({{ \App\Models\Medicament::where('qte_initial', '<', \DB::raw('qte_alerte'), 'and')->where('qte_initial', '>', 0)->count() }})
                    </th>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 bg-gray-100">medicament</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 bg-gray-100">alert</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 bg-gray-100">initial</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\Medicament::where('qte_initial', '<', \DB::raw('qte_alerte'), 'and')->where('qte_initial', '>', 0)->get() as $medicament)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{$medicament->nom}}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{$medicament->qte_alerte}}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{$medicament->qte_initial}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table class="min-w-full table-auto border-collapse bg-white shadow-lg rounded-lg overflow-hidden">
            <thead>
                <tr>
                    <th colspan="3" class="px-6 py-4 text-xl font-semibold text-center text-white bg-red-500">medicament
                        ({{ \App\Models\Medicament::where('qte_initial', '=', 0)->count() }})</th>
                </tr>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 bg-gray-100">medicament</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 bg-gray-100">alert</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 bg-gray-100">initial</th>
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\Medicament::where('qte_initial', '=', 0)->get() as $medicament)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{$medicament->nom}}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{$medicament->qte_alerte}}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{$medicament->qte_initial}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="my-6 grid grid-cols-2 py-10 gap-5">
        <div class="bg-gray-100 rounded-lg ">
            <div class="text-center bg-gradient-to-r from-pink-300 to-blue-500 p-6 rounded-t-lg text-white text-xl font-semibold">Genders</div>
            <canvas id="genderChart" class="p-6"></canvas>
        </div>
        <div class="bg-gray-100 rounded-lg">
            <div class="text-center bg-gradient-to-r from-green-300 to-red-600 p-6 rounded-t-lg text-white text-xl font-semibold">Ordonnances</div>
            <canvas id="ordonnancesChart" class="p-6"></canvas>
        </div>
    </div>
    <!-- <button class="px-4 py-2 bg-red-500 hover:bg-red-300 rounded text-white">(6) vides</button> -->
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('genderChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jeun 0-18', 'Adult 19-45', 'vieu 45+'],
                        datasets: [
                            {
                                label: 'Girls',
                                data: [-30, -20, -25], // Negative = left side
                                backgroundColor: 'rgba(255, 99, 132, 0.7)',
                                borderRadius: 7,
                                categoryPercentage: 0.0000001, // Tighten group spacing
                                barPercentage: 10000000,       // Widen bars
                            },
                            {
                                label: 'Boys',
                                data: [35, 28, 22], // Positive = right side
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderRadius: 7,
                                categoryPercentage: 0.0000001,
                                barPercentage: 10000000,
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y', // Horizontal bars
                        responsive: true,
                        scales: {
                            x: {
                                min: -50,
                                max: 50,
                                ticks: {
                                    callback: (value) => Math.abs(value), // Show absolute values
                                },
                                grid: {
                                    drawOnChartArea: true // Cleaner design
                                }
                            },
                            y: {
                                // offset: false, // Critical for alignment
                                grid: {
                                    display: false // Hide vertical grid lines
                                }
                            }
                        },
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: (ctx) => `${ctx.dataset.label}: ${Math.abs(ctx.raw)}`,
                                }
                            },
                            legend: {
                                position: 'top',
                                display: false
                            }
                        }
                    }
                });

                const cctx = document.getElementById('ordonnancesChart').getContext('2d');
                new Chart(cctx, {
                    type: 'bar',
                    data: {
                        labels: ['Completed', 'Incompleted'], // Single category for 2 bars
                        datasets: [
                            {
                                // label: 'Completed',
                                data: [40, 65], // Value for green bar
                                backgroundColor: ['rgba(75, 192, 102, 0.8)','rgba(255, 99, 102, 0.8)'], // Green
                                borderRadius: 5,
                                barPercentage: 0.5
                            },
                            // {
                            //     // label: 'Incompleted',
                            //     data: [65], // Value for red bar
                            //     backgroundColor: , // Red
                            //     borderRadius: 5,
                            //     barPercentage: 0.5 // Width of bars
                            // }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                grid: {
                                    display: false // Cleaner look
                                }
                            },
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });

        </script>
    @endpush
@endsection