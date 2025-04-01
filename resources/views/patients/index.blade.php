@extends('layout.app')
@section('mini title', 'Patients')
@section('content')
    <div class="flex justify-end px-2 py-4">
        <a href="{{ route('patients.create') }}">
            <button
                class="bg-blue-600 hover:bg-blue-500 rounded-lg px-4 py-2 text-white font-semibold cursor-pointer">ajouter</button>
        </a>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        nom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        prenom
                    </th>
                    <th scope="col" class="px-6 py-3">
                        sexe
                    </th>
                    <th scope="col" class="px-6 py-3">
                        date de naissance
                    </th>
                    <th scope="col" class="px-6 py-3">
                        adresse
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($patients as $patient)
                    <tr class="odd:bg-white odd:even:bg-gray-50 even:border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $patient->nom }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->prenom }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($patient->sexe == "Femme")
                                <i class="fa-solid fa-person-dress" style="color: pink; font-size: 20px;"></i>
                            @else
                                <i class="fa-solid fa-person" style="color: blue; font-size: 20px;"></i>
                            @endif

                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->date_naissance }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $patient->adresse }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('patients.edit', $patient->id) }}"
                                class="flex items-center gap-2 font-medium text-blue-600 hover:underline">
                                <i class="fa-solid fa-pen"></i>

                            </a>

                            <form action="{{ route('patients.destroy', $patient->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button
                                    class="flex items-center gap-2 font-medium text-red-600 hover:underline cursor-pointer mr-4">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No Patient Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection