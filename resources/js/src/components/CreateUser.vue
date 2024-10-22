<template>
    <div class="mt-5">
        <h1>Create User</h1>
        <form @submit.prevent="createUser">
            <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control" v-model="firstName" id="firstName" placeholder="First Name"/>
            </div>
            <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" v-model="lastName" id="lastName" placeholder="Last Name"/>
            </div>
            <button class="btn btn-primary" type="submit">Create User</button>
        </form>
    </div>
</template>

<script>
import {useToast} from 'vue-toastification';

export default {
    data() {
        return {
            firstName: '',
            lastName: '',
        };
    },
    methods: {
        /**
         * @returns {Promise<void>}
         */
        async createUser() {
            const toast = useToast();

            try {
                await this.$http.post('/api/users', {
                    first_name: this.firstName,
                    last_name: this.lastName,
                });

                toast.success('User created successfully!');

                this.firstName = '';
                this.lastName = '';

            } catch (error) {
                toast.error('User creation failed: ' + (error.response.data.message || error.message));
                console.error('User creation failed:', error);
            }
        },
    },
};
</script>
