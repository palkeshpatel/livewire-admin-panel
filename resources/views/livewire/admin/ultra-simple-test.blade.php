<div class="p-6 bg-yellow-100 border-2 border-yellow-400 rounded-lg">
    <h2 class="text-2xl font-bold mb-4 text-yellow-800">Ultra Simple Test</h2>
    
    <div class="space-y-4">
        <div class="p-4 bg-white rounded border">
            <p><strong>Count:</strong> {{ $count }}</p>
            @if($message)
                <p><strong>Message:</strong> {{ $message }}</p>
            @endif
        </div>

        <div class="flex gap-4">
            <button wire:click="increment" class="px-6 py-3 bg-blue-500 text-white rounded hover:bg-blue-600">
                Increment Count
            </button>
            
            <button onclick="alert('JS works!')" class="px-6 py-3 bg-green-500 text-white rounded hover:bg-green-600">
                Test JavaScript
            </button>
        </div>

        <div class="p-4 bg-gray-100 rounded text-sm">
            <p><strong>Debug:</strong></p>
            <p>Count: {{ $count }}</p>
            <p>Message: "{{ $message }}"</p>
        </div>
    </div>
</div> 