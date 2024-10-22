<template>
    <div class="mt-5">
        <h1>Login</h1>
        <form @submit.prevent="login">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input class="form-control" v-model="username" id="username" required type="text"/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input class="form-control" v-model="password" id="password" required type="password"/>
            </div>

            <button class="btn btn-primary" type="submit">Login</button>
        </form>

        <div v-if="errorMessage" style="color: red;">
            {{ errorMessage }}
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: '',
            password: '',
            errorMessage: '',
        };
    },
    methods: {
        /**
         * @returns {Promise<void>}
         */
        async login() {
            try {
                const response = await this.$http.post('/login', {
                    user_name: this.username,
                    password: this.password,
                });
                const token = response.data.access_token;

                if (token) {
                    localStorage.setItem('auth_token', token);

                    this.$router.go('/users');
                } else {
                    this.errorMessage = 'Login failed. No token received.';
                }
            } catch (error) {
                this.errorMessage = 'Login failed. Please check your username and password.';
            }
        },
    },
    mounted() {
        const isAuthenticated = !!localStorage.getItem('auth_token');

        if (isAuthenticated) {
            this.$router.push('/users');
        }
    },
};
</script>

