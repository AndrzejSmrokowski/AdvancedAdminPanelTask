<template>
    <div>
        <h1>Registration Page</h1>

        <v-form @submit.prevent="handleRegister">
            <v-text-field
                label="Full Name"
                v-model="name"
                :rules="[rules.required]"
                required
            ></v-text-field>

            <v-text-field
                label="Email"
                type="email"
                v-model="email"
                :rules="[rules.required, rules.email]"
                required
            ></v-text-field>

            <v-text-field
                label="Password"
                type="password"
                v-model="password"
                :rules="[rules.required]"
                required
            ></v-text-field>

            <v-text-field
                label="Confirm Password"
                type="password"
                v-model="password_confirmation"
                :rules="[rules.required]"
                required
            ></v-text-field>

            <v-btn type="submit">Register</v-btn>
        </v-form>
    </div>
</template>

<script>

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            rules: {
                required: (value) => !!value || "Required.",
                email: (value) => /.+@.+\..+/.test(value) || "Invalid email.",
            },
        };
    },
    methods: {
        handleRegister() {
            this.$inertia.post('/auth/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation,
            })
        }
    },
};
</script>
