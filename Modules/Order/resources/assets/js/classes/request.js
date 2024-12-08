import Errors from "./errors.js";

export default class Request {
    constructor(data) {
        this.data = data;
        this.errors = new Errors();
    }

    reset() {
        this.data = {};
        this.errors.clear();
    }

    update(url) {
        return this.submit("patch", url);
    }

    submit(requestType, url) {
        return new Promise((resolve, reject) => {
            axios[requestType](url, this.data)
                .then((response) => {
                    this.onSuccess();
                    resolve(response.data);
                })
                .catch((error) => {
                    this.onFail(error.response.data);
                    reject(error.response.data);
                });
        });
    }

    onSuccess() {
        this.reset();
    }

    onFail(errors) {
        this.errors.record(errors);
    }
}
