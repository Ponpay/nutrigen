@props(['items' => []])

<x-ui.card padding="p-5">
    <x-ui.section-title title="Persiapan Posyandu" class="mb-5" />
    <ul class="space-y-4">
        @forelse($items as $item)
            <li class="flex items-start group">
                <div class="w-6 h-6 rounded-[8px] flex-shrink-0 flex items-center justify-center border-2 transition-colors 
                    {{ ($item['checked'] ?? false) ? 'bg-brand border-brand text-white' : 'bg-gray-50 border-gray-200 text-transparent' }}">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-3 mt-0.5">
                    <p class="text-[13.5px] font-bold leading-tight {{ ($item['checked'] ?? false) ? 'text-gray-400 line-through' : 'text-gray-700' }}">
                        {{ $item['task'] }}
                    </p>
                </div>
            </li>
        @empty
            <!-- Fallback Dummy for Dev -->
            <li class="flex items-start">
                <div class="w-6 h-6 rounded-[8px] bg-brand border-2 border-brand text-white flex-shrink-0 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-3 mt-0.5"><p class="text-[13.5px] font-bold text-gray-400 line-through leading-tight">Bawa Buku KIA (KMS)</p></div>
            </li>
            <li class="flex items-start">
                <div class="w-6 h-6 rounded-[8px] bg-gray-50 border-2 border-gray-200 text-transparent flex-shrink-0 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div class="ml-3 mt-0.5"><p class="text-[13.5px] font-bold text-gray-700 leading-tight">Bawa Fotokopi KK (Bila belum daftar)</p></div>
            </li>
        @endforelse
    </ul>
</x-ui.card>
