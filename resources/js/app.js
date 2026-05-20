import Alpine from 'alpinejs'
import livewire from '@livewire/alpine'

// Initialize Alpine with Livewire plugin
Alpine.plugin(livewire)

// Make Alpine available globally
window.Alpine = Alpine

// Start Alpine
Alpine.start()

// Bootstrap (if needed)
import './bootstrap'
