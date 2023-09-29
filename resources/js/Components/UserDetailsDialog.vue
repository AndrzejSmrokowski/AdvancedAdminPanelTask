<template>
    <v-dialog v-model="internalDialog" max-width="500px">
        <v-card>
            <v-card-title>
                <span class="text-h5">User Details</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <div><strong>Name:</strong> {{ selectedUser.name }}</div>
                            <div><strong>Email:</strong> {{ selectedUser.email }}</div>
                            <div><strong>Role:</strong> {{ selectedUser.role }}</div>
                            <div><strong>Number of Posts:</strong> {{ selectedUser.posts }}</div>
                            <div><strong>Created At:</strong> {{ selectedUser.created_at }}</div>
                            <div><strong>Updated At:</strong> {{ selectedUser.updated_at }}</div>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" @click="close">Close</v-btn>
                <v-btn color="orange darken-1" @click="editUser">Edit</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        dialog: Boolean,
        selectedUser: Object,
    },
    computed: {
        internalDialog: {
            get() {
                return this.dialog;
            },
            set(value) {
                this.$emit('update:dialog', value);
            },
        },
    },
    methods: {
        close() {
            this.internalDialog = false;
        },
        editUser() {
            this.$emit('editUser', this.selectedUser);
        },
    },
    mounted() {
        console.log(this.selectedUser);
    }

};
</script>
