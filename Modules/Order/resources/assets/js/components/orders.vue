<template>
    <div class="rounded-xl bg-white">
        <div class="mx-14 py-2.5 border-b border-slate-100 last:border-b-0 last:pb-8" v-for="order in orders">
            <div class="flex my-4 mx-2.5">
                <div class="flex-1">
                    <p class="mt-1" v-text="'Order #' + order.id"></p>
                </div>

                <div class="flex-2" v-if="isNotReady(order)">
                    <button
                        @click="updateOrder(order)"
                        class="bg-sky-500 hover:bg-sky-600 pt-1 pb-1.5 px-5 min-w-24 rounded-3xl text-white transition ease-in-out delay-75"
                    >
                        {{ capitalizeFirstLetter(nextStatus(order)) }}
                    </button>
                </div>
            </div>
            <div class="flex mt-6 mb-4 ml-5 mr-8">
                <div class="flex-1">
                    <p class="mb-2 ml-1" :class="getElementColour(order.status, 'new')">new</p>
                    <i class="fa-solid fa-cart-shopping fa-2x"  :class="getElementColour(order.status, 'new')"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-200 mb-2" :class="getElementColour(order.status, 'prepare')">prepare</p>
                    <i class="fa-solid fa-kitchen-set fa-2x text-gray-200 ml-2.5" :class="getElementColour(order.status, 'prepare')"></i>
                </div>
                <div class="flex-1">
                    <p class="text-gray-200 mb-2 ml-0.5" :class="getElementColour(order.status, 'cook')">cook</p>
                    <i class="fa-solid fa-fire-burner fa-2x text-gray-200" :class="getElementColour(order.status, 'cook')"></i>
                </div>
                <div class="flex-2">
                    <p class="text-gray-200 mb-2" :class="getElementColour(order.status, 'ready')">ready</p>
                    <i class="fa-solid fa-truck-fast fa-2x text-gray-200" :class="getElementColour(order.status, 'ready')"></i>
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
                let updatedOrder = response.order;
                let updatedOrderIndex = orders.value.findIndex((order) => order.id === updatedOrder.id);
                orders.value[updatedOrderIndex] = updatedOrder;
            });
    }

    const nextStatus = (order) => {
        let orderStatusIndex = statuses.value.indexOf(order.status);

        return statuses.value[orderStatusIndex + 1];
    }

    const capitalizeFirstLetter = (val) => {
        return String(val).charAt(0).toUpperCase() + String(val).slice(1);
    }

    const getElementColour = (orderStatus, elementStatus) => {
        let ordersStatusIndex = statuses.value.indexOf(orderStatus);
        let elementStatusIndex = statuses.value.indexOf(elementStatus);

        return ordersStatusIndex >= elementStatusIndex ? 'text-blue-800' : 'text-gray-200'

    }

    const isNotReady = (order) => order.status !== 'ready';
</script>

<style>
    .hello {
        background: green;
    }
</style>
