<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>
                        Dashboard
                    </v-card-title>
                    <v-card-text>
                        <p>Welcome to the admin panel.</p>
                    </v-card-text>
                </v-card>
            </v-col>
            <v-col cols="12" md="6" v-for="user in users" :key="user.id">
                <UserCard :user="user" />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import UserCard from '@/Components/UserCard.vue';

export default {
    components: {
        UserCard,
    },
    data() {
        return {
            users: [
                { id: 1, name: 'John Doe', email: 'john@example.com', role: 'Admin' },
                { id: 2, name: 'Jane Doe', email: 'jane@example.com', role: 'User' },
                // ...more users
            ],
        };
    },
};
</script>
