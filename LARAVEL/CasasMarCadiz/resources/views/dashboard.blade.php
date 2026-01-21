<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(isset($alert) && $alert)
                <div class="bg-red-600 text-white p-4 rounded-lg mb-6 font-bold shadow-lg animate-pulse">
                    ⚠️ ¡ALERTA METEOROLÓGICA! Se detectan condiciones adversas: {{ $weather['weather'][0]['description'] }}.
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(isset($weather) && $weather)
                        <div class="mb-8 p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <h3 class="text-lg font-bold text-blue-800 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path></svg>
                                El tiempo en {{ $weather['name'] }}
                            </h3>
                            <div class="mt-2 grid grid-cols-2 gap-4">
                                <p class="text-sm"><strong>Temperatura:</strong> {{ $weather['main']['temp'] }}°C</p>
                                <p class="text-sm"><strong>Cielo:</strong> {{ ucfirst($weather['weather'][0]['description']) }}</p>
                            </div>
                        </div>
                    @else
                        <div class="mb-8 bg-yellow-50 border-l-4 border-yellow-400 p-4 text-yellow-700">
                            <p class="text-sm">
                                📍 <strong>Ubicación no configurada:</strong> 
                                <a href="{{ route('profile.edit') }}" class="underline font-bold">Configura tu latitud y longitud</a> para ver el clima local.
                            </p>
                        </div>
                    @endif

                    <div class="pt-4 border-t border-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>