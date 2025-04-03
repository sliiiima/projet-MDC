@extends('layout.app')
@section('mini title', 'Medicaments')
@section('content')
    <div class="flex justify-end px-2 py-4">
        <a href="{{ route('medicaments.create') }}">
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
                        description
                    </th>
                    <th scope="col" class="px-6 py-3">
                        type
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>
                    <th scope="col" class="px-6 py-3">
                        quantite alert
                    </th>
                    <th scope="col" class="px-6 py-3">
                        quantite initiale
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicaments as $medicament)
                    <tr class="odd:bg-white odd:even:bg-gray-50 even:border-b border-gray-200">
                        <td class="px-6 py-4">
                            {{ $medicament->nom }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicament->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicament->type->nom_type }}
                        </td>
                        <td class="px-6 py-4">
                            @if($medicament->qte_initial>$medicament->qte_alerte)
                                <i class="fa-solid fa-circle text-green-500 text-xs"></i>
                            @elseif(0<$medicament->qte_initial && $medicament->qte_initial<=$medicament->qte_alerte)
                                <i class="fa-solid fa-circle text-orange-500 text-xs"></i>
                            @else
                                <i class="fa-solid fa-circle text-red-500 text-xs"></i>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicament->qte_alerte }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $medicament->qte_initial }}
                        </td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('medicaments.edit', $medicament->id) }}"
                                class="flex items-center gap-2 font-medium text-blue-600 hover:underline">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('medicaments.destroy', $medicament->id) }}" method="post">
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
                        <td colspan="6" class="text-center py-4">No Medicaments Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection