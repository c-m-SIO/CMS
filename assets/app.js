// app.js
import 'bootstrap/dist/css/bootstrap.min.css'; // Pour le CSS
import 'bootstrap'; // Pour les JavaScript de Bootstrap (dropdowns, modals, etc.)
import './styles/app.css';


console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
// app.js

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

