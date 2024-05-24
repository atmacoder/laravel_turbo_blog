import './bootstrap';
import '../css/app.css';
import Alpine from 'alpinejs'
import Clipboard from '@ryangjchandler/alpine-clipboard' // Import it

Alpine.plugin(Clipboard) // Register the plugin

window.Alpine = Alpine
window.Alpine.start()
