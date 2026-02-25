<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des Congés
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Succès !</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="flex justify-end mb-4">
                        <a href="{{ route('leaves.create') }}" 
                           class="bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-2 px-4 rounded shadow-lg transition duration-150 ease-in-out">
                            + Nouvelle Demande
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Employé
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Dates
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Type / Motif
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Statut
                                    </th>
                                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($leaves as $leave)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <div class="font-bold text-gray-900">
                                            {{ $leave->employee->first_name }} {{ $leave->employee->last_name }}
                                        </div>
                                        <div class="text-gray-500 text-xs">
                                            {{ $leave->employee->department->name ?? '' }}
                                        </div>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">
                                            Du {{ $leave->start_date->format('d/m/Y') }}
                                        </p>
                                        <p class="text-gray-600 whitespace-no-wrap">
                                            au {{ $leave->end_date->format('d/m/Y') }}
                                        </p>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <span class="block text-gray-900 font-semibold">{{ ucfirst($leave->type) }}</span>
                                        <span class="text-gray-500 italic">{{ Str::limit($leave->reason, 20) }}</span>
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        @if($leave->status == 'pending')
                                            <span class="relative inline-block px-3 py-1 font-semibold text-yellow-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-yellow-200 opacity-50 rounded-full"></span>
                                                <span class="relative">En attente</span>
                                            </span>
                                        @elseif($leave->status == 'approved')
                                            <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Validé</span>
                                            </span>
                                        @else
                                            <span class="relative inline-block px-3 py-1 font-semibold text-red-900 leading-tight">
                                                <span aria-hidden class="absolute inset-0 bg-red-200 opacity-50 rounded-full"></span>
                                                <span class="relative">Refusé</span>
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        
                                        {{-- Cas 1 : C'est un ADMIN et le statut est EN ATTENTE --}}
                                        @if(auth()->user()->role === 'admin' && $leave->status === 'pending')
                                            <div class="flex space-x-2">
                                                <form action="{{ route('leaves.approve', $leave->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="text-green-600 hover:text-green-900 font-bold text-lg" title="Valider">
                                                        ✅
                                                    </button>
                                                </form>
                                    
                                                <form action="{{ route('leaves.reject', $leave->id) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-lg" title="Refuser">
                                                        ❌
                                                    </button>
                                                </form>
                                            </div>

                                        {{-- Cas 2 : C'est un EMPLOYÉ et c'est en attente --}}
                                        @elseif($leave->status === 'pending')
                                            <span class="text-yellow-600 text-xs italic font-semibold">
                                                En attente de validation...
                                            </span>

                                        {{-- Cas 3 : C'est déjà traité (Validé ou Refusé) --}}
                                        @else
                                            <span class="text-gray-400 text-xs italic">Traité</span>
                                        @endif

                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-gray-500">
                                        Aucune demande de congé pour le moment.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $leaves->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>