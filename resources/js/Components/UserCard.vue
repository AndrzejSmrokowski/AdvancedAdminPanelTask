<template>
    <v-card>
        <v-card-title>
            {{ user.name }}
        </v-card-title>
        <v-card-text>
            <p>Email: {{ user.email }}</p>
            <p>Role: {{ user.role }}</p>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    props: {
        user: Object,
    },
};
</script>
