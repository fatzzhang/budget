//vendors
import $ from 'jquery';
import 'bootstrap/js/dist/collapse';

//modules
import './app.js';
import './modules/index.js';

//style
import '../scss/main.scss';





$(function() {
    app.init(['index']);
})