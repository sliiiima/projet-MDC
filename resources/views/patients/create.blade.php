@extends('layout.app')
@section('mini title', 'Ajouter un Patient')
@section('content')
    <form action="{{ route('patients.store') }}" method="post">
        @csrf
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 ">Nom</label>
                <input type="text" id="nom" name="nom"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
            <div>
                <label for="prenom" class="block mb-2 text-sm font-medium text-gray-900 ">Prenom</label>
                <input type="text" id="prenom" name="prenom"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
            <div>
                <label for="sexe" class="block mb-2 text-sm font-medium text-gray-900 ">sexe</label>
                <label class="inline-flex items-center cursor-pointer mt-2">
                    <span class="ms-3 text-sm font-medium text-gray-900 pr-4 pb-1">Femme</span>
                    <input type="checkbox" name="sexe" class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-pink-600 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600 ">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 pb-1">Homme</span>
                </label>
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 ">Adresse</label>
                <input type="text" id="adresse" name="adresse"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Adresse" required />
            </div>
            <div>
                <label for="date_naissance" class="block mb-2 text-sm font-medium text-gray-900 ">date de naissance
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                        </svg>
                    </div>
                    <input id="datepicker-autohide" datepicker datepicker-autohide datepicker-format="yyyy-mm-dd"
                        type="text" name="date_naissance"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  "
                        placeholder="Select date">
                </div>
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Submit</button>
        <a href="{{ route('patients.index') }}"><button type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Annuler</button></a>
    </form>
@endsection