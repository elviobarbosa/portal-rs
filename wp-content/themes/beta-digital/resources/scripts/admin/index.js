import $ from 'jquery';
import './editor/button';


function domReady(fn) {
    // If we're early to the party
    document.addEventListener("DOMContentLoaded", fn);
    // If late; I mean on time.
    if (document.readyState === "interactive" || document.readyState === "complete" ) {
     
    }
}

const init = function() {
  
}

window.onload = function() {
  init();
};

domReady(() => { })
