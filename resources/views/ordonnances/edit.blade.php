@extends('layout.app')

@section('title', 'Edit Prescription')

@section('content')
<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Prescription</h3>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <form action="{{ route('ordonnances.update', $ordonnance) }}" method="POST" id="prescriptionForm">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="patient_id" class="block text-sm font-medium text-gray-700">Patient</label>
                    <div class="mt-1">
                        <select name="patient_id" id="patient_id" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('patient_id') border-red-500 @enderror">
                            <option value="">Select patient</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ old('patient_id', $ordonnance->patient_id) == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->nom }} {{ $patient->prenom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('patient_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-3">
                    <label for="date_ordonnance" class="block text-sm font-medium text-gray-700">Date</label>
                    <div class="mt-1">
                        <input type="date" name="date_ordonnance" id="date_ordonnance" value="{{ old('date_ordonnance', $ordonnance->date_ordonnance->format('Y-m-d')) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('date_ordonnance') border-red-500 @enderror">
                    </div>
                    @error('date_ordonnance')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-3">
                    <label for="statut" class="block text-sm font-medium text-gray-700">Status</label>
                    <div class="mt-1">
                        <select name="statut" id="statut" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md @error('statut') border-red-500 @enderror">
                            <option value="active" {{ old('statut', $ordonnance->statut) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('statut', $ordonnance->statut) == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ old('statut', $ordonnance->statut) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    @error('statut')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-6">
                    <div class="flex justify-between items-center">
                        <h4 class="text-sm font-medium text-gray-700">Medications</h4>
                        <button type="button" onclick="addMedication()" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Add Medication
                        </button>
                    </div>
                    <div id="medications-container" class="mt-4 space-y-4">
                        <!-- Medication rows will be added here -->
                    </div>
                    @error('medicaments')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('ordonnances.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Prescription
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    let medicationCount = 0;

    function addMedication(medicamentId = '', quantite = '') {
        const container = document.getElementById('medications-container');
        const row = document.createElement('div');
        row.className = 'grid grid-cols-1 gap-y-4 gap-x-4 sm:grid-cols-6 items-end';
        row.innerHTML = `
            <div class="sm:col-span-4">
                <label class="block text-sm font-medium text-gray-700">Medication</label>
                <select name="medicaments[${medicationCount}][id]" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="">Select medication</option>
                    @foreach($medicaments as $medicament)
                        <option value="{{ $medicament->id }}" ${medicamentId == {{ $medicament->id }} ? 'selected' : ''}>
                            {{ $medicament->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="medicaments[${medicationCount}][quantite]" min="1" value="${quantite}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
            </div>
            <div class="sm:col-span-6 flex justify-end">
                <button type="button" onclick="this.closest('.grid').remove()" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Remove
                </button>
            </div>
        `;
        container.appendChild(row);
        medicationCount++;
    }

    // Add existing medications
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($ordonnance->ordonnanceMedicaments as $ordonnanceMedicament)
            addMedication('{{ $ordonnanceMedicament->medicament_id }}', '{{ $ordonnanceMedicament->quantite }}');
        @endforeach
    });
</script>
@endpush
@endsection