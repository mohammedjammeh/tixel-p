<template>
    <div class="m-5" v-for="order in orders">
        <p v-text="order.id"></p>
    </div>
</template>

<script setup>
    import { ref, computed, onMounted } from "vue";

    let orders = ref([]);

    onMounted(() => {
        getOrders().then((value) => {
            orders.value = value;

            console.log(orders.value)
        });
    });

    function getOrders() {
        return new Promise((resolve, reject) => {
            return axios.get('/orders')
                .then(response => {
                    resolve(response.data.orders);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
</script>

<style>
    .hello {
        background: green;
    }
</style>
