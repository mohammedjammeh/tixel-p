<template>
    <div class="rounded-xl bg-white m-4">
        <div class="mx-4 md:mx-14 py-2.5 border-b border-slate-100 last:border-b-0 last:pb-8" v-for="order in orders" v-if="orders.length">
            <div class="flex mt-4 mb-0 mx-2.5 min-h-[40px]">
                <div class="flex-1">
                    <p v-text="`Order #${order.id}`" data-test="order_name"></p>
                    <p class="text-gray-600 text-sm" v-text="order.meals_names" data-test="meals_names"></p>
                </div>

                <div class="flex-2" v-if="isNotReady(order)">
                    <button
                        :data-test="`order_${order.id}_button`"
                        @click="updateOrder(order)"
                        class="bg-sky-500 hover:bg-sky-600 py-1.5 px-[18px] mt-1 rounded-3xl text-white transition ease-in-out delay-75"
                    >
                        <i
                            :data-test="`order_${order.id}_button_icon`"
                            class="fa-solid fa-1x text-gray-50 mr-0.5 mt-0.5 !ml-0"
                            :class="statusElementClasses[nextStatus(order)]['icon']"
                        >
                        </i>

                        {{ nextStatus(order) }}
                    </button>
                </div>
            </div>

            <div class="mx-2.5 mt-3 mb-4" v-if="failedOrderIds.includes(order.id)">
                <p class="text-red-800">Sorry, there was an error. Please try again or contact your admin.</p>
            </div>

            <div class="flex my-4 ml-5 mr-8">
                <div class="status-block" v-for="status in statuses">
                    <div class="min-h-6">
                        <!--loading-->
                        <div
                            v-if="nextStatus(order) === status"
                            :data-test="`order_${order.id}_${status}_loader`"
                            :class="[
                                'loader ml-2 w-[18px] h-[18px] border-2 border-[#f3f3f3] border-t-2 border-t-[#3498db] rounded-[50%]',
                                statusElementClasses[status]['loading'],
                            ]"
                        ></div>

                        <!--or display check(ed)-->
                        <i
                            v-else
                            :data-test="`order_${order.id}_${status}_check`"
                            class="fa-circle-check"
                            :class="[
                                isOrderHigher(order.status, status)
                                    ? 'text-blue-900 fa-solid'
                                    : 'text-gray-200 fa-regular',
                                statusElementClasses[status]['check'],
                            ]"
                        >
                        </i>
                    </div>

                    <!--status-->
                    <p
                        :data-test="`order_${order.id}_${status}_status`"
                        class="mb-2"
                        :class="[
                            isOrderHigher(order.status, status) ? 'text-blue-900' : 'text-gray-200',
                            statusElementClasses[status]['text'],
                        ]"
                    >
                        {{ status }}
                    </p>

                    <!--icon-->
                    <i
                        :data-test="`order_${order.id}_${status}_icon`"
                        class="fa-solid fa-2x text-center"
                        :class="[
                            isOrderHigher(order.status, status) ? 'text-blue-900' : 'text-gray-200',
                            statusElementClasses[status]['icon'],
                        ]"
                    >
                    </i>
                </div>
            </div>
        </div>
        <div v-else class="mx-4 md:mx-14 py-8">
            <p class="text-center">There are currently no orders, we will update you as soon as we have any.</p>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from "vue";
    import ordersCore from "../core/orders.js";
    import request from "../classes/request.js";

    const orders = ref([]);
    const statuses = ref([]);
    const statusElementClasses = {
        new: {
            check: "ml-3",
            loading: "",
            text: "ml-1",
            icon: "fa-cart-shopping",
        },
        prepared: {
            check: "ml-6",
            loading: "ml-5",
            text: "",
            icon: "fa-kitchen-set ml-3.5",
        },
        cooked: {
            check: "ml-5",
            loading: "ml-5",
            text: "ml-0.5",
            icon: "fa-fire-burner ml-2.5",
        },
        ready: {
            check: "ml-2.5",
            loading: "",
            text: "",
            icon: "fa-truck-fast",
        },
    };
    const failedOrderIds = ref([]);

    onMounted(() => {
        ordersCore.getAll().then((data) => {
            orders.value = data.orders;
            statuses.value = data.statuses;
        });
    });

    const updateOrder = (order) => {
        ordersCore
            .update(order.id, new request({ status: nextStatus(order) }))
            .then((response) => {
                let updatedOrder = response.order;
                let updatedOrderIndex = orders.value.findIndex((order) => order.id === updatedOrder.id);
                orders.value[updatedOrderIndex] = updatedOrder;

                removeError(order);
            })
            .catch((error) => failedOrderIds.value.push(order.id));
    };

    const removeError = (order) => {
        const orderFailedIndex = failedOrderIds.value.indexOf(order.id);

        if (orderFailedIndex > -1) {
            failedOrderIds.value.splice(orderFailedIndex, 1);
        }
    };

    const nextStatus = (order) => {
        let orderStatusIndex = statuses.value.indexOf(order.status);

        return statuses.value[orderStatusIndex + 1];
    };

    const isNotReady = (order) => order.status !== "ready";

    const isOrderHigher = (orderStatus, elementStatus) => {
        let ordersStatusIndex = statuses.value.indexOf(orderStatus);
        let elementStatusIndex = statuses.value.indexOf(elementStatus);

        return ordersStatusIndex >= elementStatusIndex;
    };
</script>

<style scoped>
    .loader {
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    .status-block:nth-child(1),
    .status-block:nth-child(2),
    .status-block:nth-child(3) {
        flex: 1 1 0;
    }
</style>
