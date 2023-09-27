<template>
    <div>
        <h1>Post Not Found</h1>
        <p>The post you are looking for could not be found.</p>
        <v-btn @click="goBack">Go Back</v-btn>
    </div>
</template>

<script>
export default {
    methods: {
        goBack() {
            this.$inertia.visit('/posts');
        }
    }
};
</script>
