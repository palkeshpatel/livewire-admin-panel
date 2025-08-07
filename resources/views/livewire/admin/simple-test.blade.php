<div class="p-6 bg-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-blue-600">Simple Livewire Test</h2>
    
    <div class="space-y-4">
        <!-- Display Message -->
        <div class="p-4 bg-blue-100 rounded">
            <p class="text-blue-800"><strong>Message:</strong> {{ $message }}</p>
        </div>

        <!-- Test Buttons -->
        <div class="flex gap-4">
            <button wire:click="toggleModal" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Toggle Modal ({{ $showModal ? 'true' : 'false' }})
            </button>
            
            <button wire:click="updateName" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                Update Name
            </button>
            
            <button onclick="alert('JavaScript works!')" class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">
                Test JavaScript
            </button>
        </div>

        <!-- Name Display -->
        @if($name)
            <div class="p-4 bg-green-100 rounded">
                <p class="text-green-800"><strong>Name:</strong> {{ $name }}</p>
            </div>
        @endif

        <!-- Simple Modal -->
        @if($showModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded-lg shadow-xl">
                    <h3 class="text-xl font-bold mb-4">Modal is Working!</h3>
                    <p class="mb-4">If you can see this, Livewire is working correctly.</p>
                    <button wire:click="toggleModal" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Close Modal
                    </button>
                </div>
            </div>
        @endif

        <!-- Debug Info -->
        <div class="p-4 bg-gray-100 rounded text-sm">
            <p><strong>Debug Info:</strong></p>
            <p>showModal: {{ $showModal ? 'true' : 'false' }}</p>
            <p>name: "{{ $name }}"</p>
            <p>message: "{{ $message }}"</p>
        </div>
    </div>
</div> 