<x-filament-panels::page>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        * {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageModal', (id) => ({
                show: false,
                id: id,
                init() {
                    this.$watch('show', (value) => {
                        if (value) {
                            document.body.classList.add('overflow-hidden');
                        } else {
                            document.body.classList.remove('overflow-hidden');
                        }
                    });
                }
            }));
        });
    </script>
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $record->name }} - Timeline</h2>
            <span class="px-3 py-1 text-xs font-medium rounded-full" 
                style="background-color: {{ $record->status === 'Pending' ? '#FEF3C7' : 
                                        ($record->status === 'Preparation' ? '#DBEAFE' : 
                                        ($record->status === 'Process' ? '#C7D2FE' : 
                                        ($record->status === 'BAST' ? '#A7F3D0' : 
                                        ($record->status === 'Success' ? '#6EE7B7' : '#FCA5A5')))) }}; 
                        color: {{ $record->status === 'Pending' ? '#92400E' : 
                                ($record->status === 'Preparation' ? '#1E40AF' : 
                                ($record->status === 'Process' ? '#3730A3' : 
                                ($record->status === 'BAST' ? '#065F46' : 
                                ($record->status === 'Success' ? '#064E3B' : '#7F1D1D')))) }};"
            >
                {{ $record->status }}
            </span>
        </div>

        <div class="flex flex-col space-y-2 mb-6">
            <div class="flex items-center">
                <span class="text-gray-500 dark:text-gray-400 w-32">Code:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $record->code }}</span>
            </div>
            <div class="flex items-center">
                <span class="text-gray-500 dark:text-gray-400 w-32">Location:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $record->project_location }}</span>
            </div>
            <div class="flex items-center">
                <span class="text-gray-500 dark:text-gray-400 w-32">Client:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $record->thirdParty->name }}</span>
            </div>
            <div class="flex items-center">
                <span class="text-gray-500 dark:text-gray-400 w-32">Planned Date:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $record->planned_date->format('d M Y') }}</span>
            </div>
            @if($record->start_date)
            <div class="flex items-center">
                <span class="text-gray-500 dark:text-gray-400 w-32">Start Date:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $record->start_date->format('d M Y') }}</span>
            </div>
            @endif
            @if($record->end_date)
            <div class="flex items-center">
                <span class="text-gray-500 dark:text-gray-400 w-32">End Date:</span>
                <span class="font-medium text-gray-900 dark:text-white">{{ $record->end_date->format('d M Y') }}</span>
            </div>
            @endif
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6">Project Timeline</h3>
            
            @if($record->tasks->count() > 0)
                <div class="relative">
                    <!-- Vertical line -->
                    <div class="absolute left-9 top-0 h-full w-0.5 bg-gray-200 dark:bg-gray-700"></div>
                    
                    <div class="space-y-8">
                        @foreach($record->tasks->sortBy('task_date') as $task)
                            <div class="relative flex items-start mb-2">
                                <!-- Timeline dot -->
                                <div class="absolute left-9 -translate-x-1/2 w-5 h-5 rounded-full border-4 {{ $task->status === 'Completed' ? 'bg-green-500 border-green-200' : ($task->status === 'In Progress' ? 'bg-blue-500 border-blue-200' : 'bg-gray-500 border-gray-200') }} transition-all duration-300 hover:scale-125 hover:shadow-md" title="{{ $task->status }}"></div>
                                
                                <!-- Date -->
                                <div class="flex-none w-24 text-right mr-4 whitespace-nowrap">
                                    <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded-md text-xs font-medium text-gray-700 dark:text-gray-300">
                                        {{ $task->task_date->format('d M Y') }}
                                    </span>
                                </div>
                                
                                <!-- Content -->
                                <div class="ml-6 bg-white dark:bg-gray-800 shadow-sm border border-gray-200 dark:border-gray-700 rounded-lg p-4 w-full transition-all duration-200 hover:shadow-md hover:border-gray-300 dark:hover:border-gray-600">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="text-md font-semibold text-gray-900 dark:text-white">{{ $task->name }}</h4>
                                        <span class="px-2 py-1 text-xs font-medium rounded-full"
                                            style="background-color: {{ $task->status === 'Completed' ? '#D1FAE5' : ($task->status === 'In Progress' ? '#DBEAFE' : '#F3F4F6') }}; 
                                                    color: {{ $task->status === 'Completed' ? '#065F46' : ($task->status === 'In Progress' ? '#1E40AF' : '#374151') }};"
                                        >
                                            {{ $task->status }}
                                        </span>
                                    </div>
                                    
                                    @if($task->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">{{ $task->description }}</p>
                                    @endif
                                    
                                    <div class="flex flex-wrap gap-4 text-xs text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            Coordinator: {{ $task->coordinator }}
                                        </div>
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Workers: {{ $task->worker_count }}
                                        </div>
                                    </div>
                                    
                                    @if($task->photo)
                                        <div class="mt-3">
                                            <div class="cursor-pointer" x-data="{}" @click="$dispatch('open-modal', { id: 'image-modal-{{ $task->id }}' })">
                                                <img src="{{ asset('storage/' . $task->photo) }}" alt="Task Photo" class="rounded-lg w-32 h-32 object-cover hover:opacity-90 transition-opacity">
                                                <div class="text-xs text-gray-500 mt-1 flex items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                    Klik untuk memperbesar
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Modal for image -->
                                        <div
                                            x-data="imageModal('image-modal-{{ $task->id }}')"
                                            x-show="show"
                                            x-on:open-modal.window="$event.detail.id === id ? show = true : null"
                                            x-on:close-modal.window="$event.detail.id === id ? show = false : null"
                                            x-on:keydown.escape.window="show = false"
                                            x-transition:enter="ease-out duration-300"
                                            x-transition:enter-start="opacity-0"
                                            x-transition:enter-end="opacity-100"
                                            x-transition:leave="ease-in duration-200"
                                            x-transition:leave-start="opacity-100"
                                            x-transition:leave-end="opacity-0"
                                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80"
                                            style="display: none;"
                                            @click.self="show = false"
                                        >
                                            <div 
                                                class="relative max-w-4xl max-h-screen p-2"
                                                x-data="{ scale: 1, panning: false, pointX: 0, pointY: 0, start: { x: 0, y: 0 } }"
                                                @mousedown="panning = true; start = { x: $event.clientX - pointX, y: $event.clientY - pointY }"
                                                @mouseup="panning = false"
                                                @mousemove="panning ? (pointX = $event.clientX - start.x, pointY = $event.clientY - start.y) : null"
                                                @wheel.prevent="scale = Math.min(Math.max(0.5, scale + ($event.deltaY > 0 ? -0.1 : 0.1)), 3)"
                                            >
                                                <button 
                                                    @click="$dispatch('close-modal', { id: id })"
                                                    class="absolute top-2 right-2 text-white bg-gray-800 rounded-full p-1 hover:bg-gray-700 focus:outline-none z-10"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                                
                                                <div class="flex justify-center space-x-2 mb-2">
                                                    <button @click="scale = 1; pointX = 0; pointY = 0" class="text-xs bg-white bg-opacity-20 text-white px-2 py-1 rounded hover:bg-opacity-30 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                        Reset
                                                    </button>
                                                    <button @click="scale = Math.min(scale + 0.2, 3)" class="text-xs bg-white bg-opacity-20 text-white px-2 py-1 rounded hover:bg-opacity-30 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                                        </svg>
                                                        Zoom In
                                                    </button>
                                                    <button @click="scale = Math.max(scale - 0.2, 0.5)" class="text-xs bg-white bg-opacity-20 text-white px-2 py-1 rounded hover:bg-opacity-30 transition-all">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7" />
                                                        </svg>
                                                        Zoom Out
                                                    </button>
                                                </div>
                                                
                                                <div class="overflow-hidden rounded-lg cursor-move">
                                                    <img 
                                                        src="{{ asset('storage/' . $task->photo) }}" 
                                                        alt="Task Photo" 
                                                        class="max-w-full max-h-[70vh] object-contain rounded-lg transform transition-transform duration-100 ease-linear"
                                                        :style="`transform: scale(${scale}) translate(${pointX}px, ${pointY}px);`"
                                                        draggable="false"
                                                    >
                                                </div>
                                                <div class="mt-2 text-center text-white text-sm">{{ $task->name }} - {{ $task->task_date->format('d M Y') }}</div>
                                                <div class="mt-1 text-center text-gray-400 text-xs">Gunakan scroll untuk zoom, klik dan geser untuk menggerakkan gambar</div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12 text-gray-500 dark:text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-lg font-medium">No tasks found for this project</p>
                    <p class="mt-1">Tasks will appear here once they are added to the project.</p>
                </div>
            @endif
        </div>
    </div>
</x-filament-panels::page>