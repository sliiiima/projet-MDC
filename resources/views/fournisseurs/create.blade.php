@extends('layout.app')
@section('mini title', 'Ajouter un Fournisseurs')
@section('content')
    <form action="{{ route('fournisseurs.store') }}" method="post">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label for="medicament_id" class="block mb-2 text-sm font-medium text-gray-900 ">Medicament</label>
                <select id="medicament_id" name="medicament_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Choisi un Medicament</option>
                    @foreach (\App\Models\Medicament::all() as $medicament)
                        <option value="{{ $medicament->id }}">{{ $medicament->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="date_recue" class="block mb-2 text-sm font-medium text-gray-900 ">date recue</label>
                <div class="relative max-w-sm w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="datepicker-autohide" name="date_recue" datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  "
                        placeholder="Select date">
                </div>
            </div>
            <div>
                <label for="qte_recue" class="block mb-2 text-sm font-medium text-gray-900 ">Quantite recue</label>
                <input type="text" id="qte_recue" name="qte_recue"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        <a href="{{ route('fournisseurs.index') }}"><button type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Annuler</button></a>
    </form>

@endsection