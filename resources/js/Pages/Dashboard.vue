<template>
    <v-container>
        <v-row>
            <v-col cols="12" md="6">
                <v-card class="mb-4">
                    <v-card-title>User Information</v-card-title>
                    <v-card-text>
                        <UserCard :user="currentUser"/>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="goToProfile">Profile</v-btn>
                        <v-btn color="error" @click="logout">Logout</v-btn>
                        <v-btn color="green" @click="grantAdmin">Grant Admin</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
            <v-col cols="12" md="6">
                <v-card class="mb-4">
                    <v-card-title>Latest Posts</v-card-title>
                    <v-card-text>
                        <PostList :latestPosts="latestPosts"/>
                        <QuickPostComponent/>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="goToPosts">View All Posts</v-btn>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <v-btn color="secondary" @click="goToAdminPanel">Admin Panel</v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import UserCard from '@/Components/UserCard.vue';
import PostList from '@/Components/PostList.vue';
import QuickPostComponent from "@/Components/QuickPostComponent.vue";

export default {
    components: {
        UserCard,
        PostList,
        QuickPostComponent,
    },
    props: {
        currentUser: Object,
        latestPosts: Array,
    },
    methods: {
        goToPosts() {
            this.$inertia.visit('/posts');
        },
        goToProfile() {
            this.$inertia.visit('/profile');
        },
        logout() {
            this.$inertia.post('/auth/logout');
        },
        goToAdminPanel() {
            this.$inertia.visit('/admin');
        },
        grantAdmin() {
            this.$inertia.put(`/admin/change-user-role/${this.currentUser.id}`, {
                role: 'Admin'
            }, {
                onSuccess: () => {
                    this.$inertia.reload();
                }
            });
        },

    }
};
</script>
