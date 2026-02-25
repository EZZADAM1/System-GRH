<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de Bord
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ $stats['label1'] }}</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $stats['value1'] }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 {{ $stats['value2'] > 0 ? 'border-yellow-500' : 'border-green-500' }}">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ $stats['label2'] }}</div>
                    <div class="mt-2 flex items-baseline">
                        <span class="text-3xl font-bold text-gray-900">{{ $stats['value2'] }}</span>
                        @if($stats['value2'] > 0)
                            <a href="{{ route('leaves.index') }}" class="ml-2 text-sm text-blue-600 hover:underline">
                                Voir ->
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ $stats['label3'] }}</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['value3'] }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">{{ $stats['label4'] }}</div>
                    <div class="mt-2 text-2xl font-bold text-gray-900">{{ $stats['value4'] }}</div>
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Raccourcis Rapides</h3>
                    <div class="flex space-x-4">
                        
                        @if($stats['is_admin'])
                            <a href="{{ route('employees.create') }}" class="bg-blue-100 text-blue-800 px-4 py-2 rounded-lg hover:bg-blue-200 transition">
                                + Ajouter un employé
                            </a>
                        @endif

                        <a href="{{ route('leaves.create') }}" class="bg-indigo-100 text-indigo-800 px-4 py-2 rounded-lg hover:bg-indigo-200 transition">
                            + Nouvelle demande de congé
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>