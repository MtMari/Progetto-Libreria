import { Controller } from '@hotwired/stimulus';

export default class extends Controller {

    static values = { url: String, refreshInterval: Number}
    static targets = [ 'reload' ]
    
    connect(){
        this.carica();
        console.log(this.hasRefreshIntervalValue)

        if(this.hasRefreshIntervalValue) {
            this.startRefreshing()
        }
    }

    disconnect() {
        this.stopRefreshing()
    }

    // 1 resource
    // carica() {
    //     console.log('this.urlValue: ', this.urlValue);
    //     fetch(this.urlValue)
    //         .then(response => response.text())
    //         .then(html => this.element.innerHTML = html);
    // }


    // multiple resources
    carica( { params: { url } }) {
        fetch(url)
            .then(response => response.text())
            .then(html => this.element.innerHTML = html);
    }

    startRefreshing() {
        this.refreshTimer = setInterval(() => {
        this.carica()
        }, this.refreshIntervalValue)
    }

    stopRefreshing() {
        if(this.refreshTimer) {
            clearInterval(this.refreshTimer);
        }
    }
}