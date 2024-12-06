<template>
    <div class="rounded-xl bg-white">
        <div class="mx-14 py-2.5 border-b border-slate-100 last:border-b-0 last:pb-8" v-for="order in orders">
            <div class="flex py-5 la">
                <div class="flex-1">
                    <p class="mt-2" v-text="'Order #' + order.id"></p>
                </div>

                <div class="flex-2" v-if="isNotReady(order)">
                    <button
                        @click="updateOrder(order)"
                        class="bg-sky-900 hover:bg-sky-700 pt-2 pb-2.5 px-5 min-w-28 rounded-3xl text-white"
                    >
                        {{ capitalizeFirstLetter(nextStatus(order)) }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed, onMounted } from "vue";
    import ordersCore from '../core/orders.js';
    import request from '../classes/request.js';

    let orders = ref([]);
    let statuses = ref([]);

    onMounted(() => {
        ordersCore.getAll().then((data) => {
            orders.value = data.orders;
            statuses.value = data.statuses;
        });
    });

    const updateOrder = (order) => {
        ordersCore.update(order.id, new request({status: nextStatus(order)}))
            .then((response) => {
                console.log(response);
            });
    }

    const nextStatus = (order) => {
        let orderStatusIndex = statuses.value.indexOf(order.status);

        return statuses.value[orderStatusIndex + 1];
    }

    const capitalizeFirstLetter = (val) => {
        return String(val).charAt(0).toUpperCase() + String(val).slice(1);
    }

    const isNotReady = (order) => order.status !== 'ready';
</script>

<style>
    .hello {
        background: green;
    }
</style>
