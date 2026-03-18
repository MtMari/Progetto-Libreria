import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
    static targets = [ 'input', 'output', 'hidden', 'reload' ];

    sovrascrivi(){
        console.log('"data-controller" deve essere definito nell\'elemento genitore');
        console.log('this.inputTarget: ', this.inputTarget);
        console.log('this.hasInputTarget: ', this.hasInputTarget);
        console.log('this.inputTargets: ', this.inputTargets);

        this.outputTarget.textContent = this.inputTarget.value;

        this.hiddenTarget.setAttribute('class', 'not-hidden');
    }

    ricarica(){
        console.log('this.reloadTarget: ', this.reloadTarget);
        this.inputTarget.value = '';
        window.location.reload();
    }
}