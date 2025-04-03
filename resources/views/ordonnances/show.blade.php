@extends('layout.app')

@section('title', 'Prescription Details')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <div class="flex justify-between items-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Prescription Details</h3>
            <div class="flex space-x-3">
                <a href="{{ route('ordonnances.edit', $ordonnance) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Edit Prescription
                </a>
                <a href="{{ route('ordonnances.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Back to List
                </a>
            </div>
        </div>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Patient</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $ordonnance->patient->nom }} {{ $ordonnance->patient->prenom }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Date</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $ordonnance->date_ordonnance->format('d/m/Y') }}</dd>
            </div>
            <div class="sm:col-span-1">
                <dt class="text-sm font-medium text-gray-500">Status</dt>
                <dd class="mt-1 text-sm">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        @if($ordonnance->statut === 'active') bg-green-100 text-green-800
                        @elseif($ordonnance->statut === 'completed') bg-gray-100 text-gray-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($ordonnance->statut) }}
                    </span>
                </dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-sm font-medium text-gray-500">Instructions</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ $ordonnance->instructions ?: 'No instructions provided.' }}</dd>
            </div>
        </dl>
    </div>
</div>

<div class="mt-8 bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Medications</h3>
    </div>
    <div class="border-t border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($ordonnance->ordonnanceMedicaments as $ordonnanceMedicament)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $ordonnanceMedicament->medicament->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $ordonnanceMedicament->medicament->typeMedicament->nom }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $ordonnanceMedicament->quantite }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                €{{ number_format($ordonnanceMedicament->medicament->prix, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                €{{ number_format($ordonnanceMedicament->medicament->prix * $ordonnanceMedicament->quantite, 2) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                No medications found in this prescription
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="4" class="px-6 py-3 text-right text-sm font-medium text-gray-500">Total Amount:</td>
                        <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            €{{ number_format($ordonnance->ordonnanceMedicaments->sum(function($item) {
                                return $item->medicament->prix * $item->quantite;
                            }), 2) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection 