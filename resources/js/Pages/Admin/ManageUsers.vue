<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <v-card>
                    <v-card-title>
                        Manage Users
                        <v-spacer></v-spacer>
                        <v-text-field
                            v-model="search"
                            append-icon="mdi-magnify"
                            label="Search"
                            single-line
                            hide-details
                        ></v-text-field>
                    </v-card-title>
                    <v-card-text>
                        <v-data-table
                            v-model:items-per-page="itemsPerPage"
                            :headers="headers"
                            :items="formattedUsers"
                            :loading="loading"
                            :search="search"
                            class="elevation-1"
                        >
                            <template v-slot:item.action="{ item }">
                                <v-btn color="primary" @click="openDialog(item)">Details</v-btn>
                            </template>
                        </v-data-table>
                    </v-card-text>
                    <UserDetailsDialog
                        :selectedUser="selectedUser"
                        :dialog="dialog"
                        @update:dialog="dialog = $event"
                        @editUser="showEditDialog"
                    />
                    <UserEditDialog
                        :selectedUser="selectedUser"
                        :roles="roles"
                        :dialog="editDialog"
                        @update:dialog="editDialog = $event"
                    />
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import moment from 'moment';
import UserDetailsDialog from '@/Components/UserDetailsDialog.vue';
import UserEditDialog from "@/Components/UserEditDialog.vue";

export default {
    components: {
        UserDetailsDialog,
        UserEditDialog,
    },
    props: {
        users: Array,
    },
    data() {
        return {
            itemsPerPage: 5,
            loading: false,
            search: '',
            headers: [
                { title: 'Name', key: 'name', align: 'start' },
                { title: 'Email', key: 'email', align: 'start' },
                { title: 'Role', key: 'role', align: 'start' },
                { title: 'Posts', key: 'posts', align: 'start' },
                { title: 'Created At', key: 'created_at', align: 'end' },
                { title: 'Updated At', key: 'updated_at', align: 'end' },
                { title: 'Actions', key: 'action', align: 'end', sortable: false },
            ],
            roles: ['Admin', 'Editor', 'User'],
            dialog: false,
            editDialog: false,
            selectedUser: null,
        };
    },
    methods: {
        openDialog(user) {
            this.selectedUser = user.selectable;
            console.log(this.selectedUser);
            this.dialog = true;
        },
        showEditDialog(user) {
            this.selectedUser = user;
            this.editDialog = true;
            this.dialog = false;
        }
    },
    computed: {
        formattedUsers() {
            return this.users.map(user => {
                user.created_at = moment(user.created_at).format('YYYY-MM-DD HH:mm');
                user.updated_at = moment(user.updated_at).format('YYYY-MM-DD HH:mm');
                user.role = user.role || 'N/A';
                user.posts = user.posts ? user.posts.length : 0;
                return user;
            });
        },
    },
};
</script>
