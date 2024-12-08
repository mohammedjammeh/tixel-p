export default {
    routes: {
        index: "/orders",
        update: (orderId) => "/orders/" + orderId,
    },

    getAll() {
        return new Promise((resolve, reject) => {
            return axios
                .get(this.routes.index)
                .then((response) => resolve(response.data))
                .catch((error) => reject(error));
        });
    },

    update(orderId, request) {
        return new Promise((resolve, reject) => {
            return request
                .update(this.routes.update(orderId))
                .then((response) => resolve(response))
                .catch((error) => reject(error));
        });
    },
};
