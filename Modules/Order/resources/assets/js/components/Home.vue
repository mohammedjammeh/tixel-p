<template>
    <h1>Hey</h1>
</template>

<script setup>
    import { ref, computed, onMounted } from "vue";

    onMounted(() => {
        return axios.get('/orders')
            .then(response => {
                console.log(response.data);
            })
            .catch(error => {
                console.log(error.response.data.errors);
            });
    });
</script>
