import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = [ "input" ];
    
    copia(event){
        console.log('tasto copia cliccato');
        console.log(event);
        
        event.preventDefault();
        navigator.clipboard.writeText(this.inputTarget.value);
    }
}