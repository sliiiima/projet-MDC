@extends('layout.app')
@section('mini title', 'Modifier un Medicament')
@section('content')
    <form action="{{ route('medicaments.update',$medicament->id) }}" method="post">
        @csrf
        @method('put')
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 ">Nom</label>
                <input type="text" id="nom" name="nom" value="{{ $medicament->nom }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
            <div>
                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                <input type="text" id="description" name="description" value="{{ $medicament->description }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
            <div>
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 ">Type</label>
                <select id="type" name="type_medicament_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                    <option selected>Choisi un Type</option>
                    @foreach (\App\Models\TypeMedicament::all() as $type)
                        <option value="{{ $type->id }}" @if($medicament->type_medicament_id == $type->id) selected @endif>{{ $type->nom_type }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-2">
            {{-- <div>
                <label for="est_active" class="block mb-2 text-sm font-medium text-gray-900 ">Est active</label>
                <label class="inline-flex items-center justify-center cursor-pointer mt-2 w-full">
                    <span class="ms-3 text-sm font-medium text-gray-900 pr-4 pb-1">Non</span>
                    <input type="checkbox" name="est_active" class="sr-only peer" @if($medicament->est_active) checked @endif>
                    <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all  peer-checked:bg-blue-600 ">
                    </div>
                    <span class="ms-3 text-sm font-medium text-gray-900 pb-1">Oui</span>
                </label>
            </div> --}}
            <div>
                <label for="qte_alerte" class="block mb-2 text-sm font-medium text-gray-900 ">Quantite Alerte</label>
                <input type="text" id="qte_alerte" name="qte_alerte" value="{{ $medicament->qte_alerte }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
            <div>
                <label for="qte_initial" class="block mb-2 text-sm font-medium text-gray-900 ">Quantite Initial</label>
                <input type="text" id="qte_initial" name="qte_initial" value="{{ $medicament->qte_initial }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                    placeholder="Flowbite" required />
            </div>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Enregistrer</button>
        <a href="{{ route('medicaments.index') }}"><button type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center ">Annuler</button></a>
    </form>

@endsection