<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>
                        Admin Dashboard
                    </v-card-title>
                    <v-card-text>
                        <p>Welcome to the admin panel.</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" md="4">
                <v-card @click="goTo('users')">
                    <v-card-title>
                        Manage Users
                    </v-card-title>
                </v-card>
            </v-col>
            <v-col cols="12" md="4">
                <v-card @click="goTo('posts')">
                    <v-card-title>
                        Manage Posts
                    </v-card-title>
                </v-card>
            </v-col>
            <v-col cols="12" md="4">
                <v-card @click="goTo('roles')">
                    <v-card-title>
                        Manage Roles
                    </v-card-title>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    methods: {
        goTo(section) {
            this.$inertia.visit(`/admin/${section}`);
        },
    },
};
</script>
