<template>
    <div class="rounded-xl bg-white">
        <div class="mx-14 py-2.5 border-b border-slate-100 last:border-b-0 last:pb-8" v-for="order in orders">
            <div class="flex my-4 mx-2.5 min-h-[40px]">
                <div class="flex-1">
                    <p class="mt-1.5" v-text="'Order #' + order.id"></p>
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
            <div class="flex mb-4 ml-5 mr-8">
                <div
                    class="[&:nth-child(1)]:flex-1 [&:nth-child(2)]:flex-1 [&:nth-child(3)]:flex-1"
                    v-for="status in statuses"
                >
                    <i
                        class="fa-circle-check text-blue-800"
                        :class="[
                            isOrderHigher(order.status, status) ? 'fa-solid' : 'fa-regular',
                            statusElementClasses[status]['check']
                        ]"
                    >
                    </i>
                    <p
                        class="text-gray-200 mb-2"
                        :class="[
                            isOrderHigher(order.status, status) ? 'text-blue-800' : 'text-gray-200',
                            statusElementClasses[status]['text']
                        ]"
                    >
                        {{ status }}
                    </p>
                    <i
                        class="fa-solid fa-2x"
                        :class="[
                            isOrderHigher(order.status, status) ? 'text-blue-800' : 'text-gray-200',
                            statusElementClasses[status]['icon']
                        ]"
                    >
                    </i>
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
    let statusElementClasses = {
        new: {
            check: 'ml-2.5',
            text: 'ml-1',
            icon: 'fa-cart-shopping',
        },
        prepare: {
            check: 'ml-5',
            text: '',
            icon: 'fa-kitchen-set ml-2.5',
        },
        cook: {
            check: 'ml-2.5',
            text: 'ml-0.5',
            icon: 'fa-fire-burner',
        },
        ready: {
            check: 'ml-2.5',
            text: '',
            icon: 'fa-truck-fast',
        },
    };

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

    const isOrderHigher = (orderStatus, elementStatus) => {
        let ordersStatusIndex = statuses.value.indexOf(orderStatus);
        let elementStatusIndex = statuses.value.indexOf(elementStatus);

        return ordersStatusIndex >= elementStatusIndex;
    }

    const isNotReady = (order) => order.status !== 'ready';
</script>

<style>
    .hello {
        background: green;
    }
</style>
