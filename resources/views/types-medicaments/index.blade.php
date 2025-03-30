@extends('layout.app')
@section('mini title','Type des Medicaments')
@section('content')
<div class="flex justify-end px-2 py-4">
    <form action="{{ route('types-medicaments.store') }}" method="post" class="flex w-full gap-2">
        @csrf
        <div class="relative w-full">
            <input type="text" id="default_outlined" name="nom_type" required class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none    focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
            <label for="default_outlined" class="absolute text-sm text-gray-500  duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white  px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus: peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Type de Medicament</label>
        </div>
        <button type="submit" class="bg-blue-600 hover:bg-blue-500 rounded-lg px-4 py-2 text-white font-semibold cursor-pointer">ajouter</button>
    </form>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
                <th scope="col" class="px-6 py-3">
                    nom de type
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($types as $type)
            <tr class="odd:bg-white odd:even:bg-gray-50 even:border-b border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    {{ $type->nom_type }}
                </th>
                <td class="px-6 py-4">
                    <form action="{{ route('types-medicaments.destroy',$type->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="font-medium text-red-600 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center py-4">No Type de Medicament Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection