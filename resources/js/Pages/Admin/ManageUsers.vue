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
                    <UserDetailsDialog :roles="roles" :dialog="dialog" @update:dialog="dialog = $event"/>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import moment from 'moment';
import UserDetailsDialog from '@/Components/UserDetailsDialog.vue';

export default {
    components: {
        UserDetailsDialog: UserDetailsDialog,
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
                { title: 'Created At', key: 'created_at', align: 'end' },
                { title: 'Updated At', key: 'updated_at', align: 'end' },
                { title: 'Actions', key: 'action', align: 'end', sortable: false },
            ],
            roles: ['Admin', 'Editor', 'User'],
            dialog: false,
        };
    },
    methods: {
        openDialog(user) {
            this.selectedUser = user;
            this.dialog = true;
        },
        closeDialog() {
            this.dialog = false;
        },
    },
    computed: {
        formattedUsers() {
            return this.users.map(user => {
                user.created_at = moment(user.created_at).format('YYYY-MM-DD HH:mm');
                user.updated_at = moment(user.updated_at).format('YYYY-MM-DD HH:mm');
                return user;
            });
        },
    },
};

</script>
