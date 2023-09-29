<template>
    <v-dialog v-model="internalDialog" max-width="500px">
        <v-card>
            <v-card-title>
                <span class="text-h5">Edit User</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12">
                            <v-text-field label="Name" v-model="editedUser.name"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                label="Email"
                                v-model="editedUser.email"
                                :rules="emailRules"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-select
                                :items="roles"
                                label="Assign Role"
                                v-model="editedUser.role"
                            ></v-select>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" @click="close">Close</v-btn>
                <v-btn color="green darken-1" @click="save">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        dialog: Boolean,
        selectedUser: Object,
        roles: Array,
    },
    data() {
        return {
            editedUser: {},
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
        };
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
    watch: {
        selectedUser: {
            immediate: true,
            handler(val) {
                this.editedUser = Object.assign({}, val);
            },
        },
    },
    methods: {
        close() {
            this.internalDialog = false;
        },
        save() {
            this.$inertia.put(`/admin/edit-user/${this.editedUser.id}`, this.editedUser, {
                onSuccess: () => {
                    this.$emit('userUpdated');
                    this.internalDialog = false;
                },
            });
        },
    },
};
</script>
