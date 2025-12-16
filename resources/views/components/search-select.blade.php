@props(['options', 'name', 'placeholder' => 'Pilih...', 'label'])

<div x-data="{ 
    open: false, 
    search: '', 
    selected: '', 
    options: {{ json_encode($options) }},
    
    get filteredOptions() {
        if (this.search === '') return this.options;
        return this.options.filter(option => 
            option.toLowerCase().includes(this.search.toLowerCase())
        );
    },

    selectOption(value) {
        this.selected = value;
        this.open = false;
        this.search = '';
    }
}" 
@click.away="open = false"
class="relative w-full border-b md:border-b-0 md:border-r border-gray-200 pb-3 md:pb-0 md:pr-4 last:border-0 last:pr-0">

    <input type="hidden" :name="'{{ $name }}'" :value="selected">

    <label class="block text-[10px] md:text-xs font-bold text-gray-500 uppercase tracking-wide mb-1">
        {{ $label }}
    </label>
    
    <button type="button" @click="open = !open" 
            class="w-full text-left flex justify-between items-center bg-transparent focus:outline-none group py-1">
        
        <span x-text="selected ? selected : '{{ $placeholder }}'" 
              :class="selected ? 'text-nature-dark font-extrabold' : 'text-gray-800 font-semibold'"
              class="text-sm md:text-base truncate block w-full transition-colors duration-200">
        </span>
        
        <svg class="w-4 h-4 text-nature-dark opacity-70 group-hover:opacity-100 transition transform duration-200" 
             :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>

    <div x-show="open" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         class="absolute z-50 left-0 mt-2 w-full md:w-64 bg-white rounded-xl shadow-xl border border-gray-100 max-h-60 overflow-hidden flex flex-col">
        
        @if(count($options) > 10)
        <div class="p-2 border-b border-gray-100 bg-gray-50 sticky top-0">
            <input x-model="search" type="text" placeholder="Cari..." 
                   class="w-full text-sm border-gray-200 rounded-lg focus:border-nature-dark focus:ring-nature-dark bg-white px-3 py-2 text-gray-800 placeholder-gray-400">
        </div>
        @endif

        <ul class="overflow-y-auto flex-1 p-1 custom-scrollbar">
            <li @click="selectOption('')" 
                class="px-4 py-2 text-sm text-gray-500 hover:bg-gray-50 cursor-pointer rounded-lg mb-1 italic">
                Semua / Reset
            </li>

            <template x-for="option in filteredOptions" :key="option">
                <li @click="selectOption(option)" 
                    class="px-4 py-2 text-sm text-gray-700 hover:bg-nature-cream hover:text-nature-dark hover:font-bold cursor-pointer rounded-lg transition"
                    :class="selected === option ? 'bg-nature-cream font-bold text-nature-dark' : ''">
                    <span x-text="option"></span>
                </li>
            </template>
            
            <li x-show="filteredOptions.length === 0" class="px-4 py-3 text-sm text-gray-400 text-center">
                Tidak ditemukan.
            </li>
        </ul>
    </div>
</div>