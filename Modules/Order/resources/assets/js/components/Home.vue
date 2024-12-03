<template>
    <h1 class="bg-purple-700">hello</h1>
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

<style>
    .hello {
        background: green;
    }
</style>
