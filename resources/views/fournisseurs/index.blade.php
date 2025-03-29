@extends('layout.app')
@section('mini title','Fournisseurs')
@section('content')
<div class="flex justify-end px-2 py-4">
    <a href="{{ route('fournisseurs.create') }}">
        <button class="bg-blue-600 hover:bg-blue-500 rounded-lg px-4 py-2 text-white font-semibold cursor-pointer">ajouter</button>
    </a>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Medicament
                </th>
                <th scope="col" class="px-6 py-3">
                    quantite recu
                </th>
                <th scope="col" class="px-6 py-3">
                    date recu
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($fournisseurs as $fourn)
            <tr class="odd:bg-white odd:even:bg-gray-50 even:border-b border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ $fourn->medicament }}
                </th>
                <td class="px-6 py-4">
                    {{ $fourn->qte_recuu }}
                </td>
                <td class="px-6 py-4">
                    {{ $fourn->date_recu }}
                </td>
                <td class="px-6 py-4">
                    <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                    <a href="#" class="font-medium text-red-600 hover:underline">Delete</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4">No Fournisseur Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection