<template>
    <div class="mt-5">
        <h1>Users List</h1>
        <div class="mb-4">
            <h5>Search Users</h5>
            <div class="row">
                <div class="col">
                    <input
                        type="text"
                        v-model="searchUserName"
                        class="form-control"
                        placeholder="Search by User Name"
                        @input="onSearchInput"
                    />
                </div>
                <div class="col">
                    <input
                        type="text"
                        v-model="searchFirstName"
                        class="form-control"
                        placeholder="Search by First Name"
                        @input="onSearchInput"
                    />
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">User Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" :key="user.id">
                <th scope="row">{{ user.id }}</th>
                <td>{{ user.user_name }}</td>
                <td>{{ user.first_name }}</td>
                <td>{{ user.last_name }}</td>
                <td>
                    <button class="btn btn-danger" @click="deleteUser(user)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import { useToast } from 'vue-toastification';

export default {
    data() {
        return {
            users: [],
            searchUserName: '',
            searchFirstName: '',
            timeout: null,
        };
    },
    created() {
        this.fetchUsers();
    },
    methods: {
        async fetchUsers() {
            try {
                const response = await this.$http.get('/api/users', {
                    params: {
                        user_name: this.searchUserName,
                        first_name: this.searchFirstName,
                    },
                });
                this.users = response.data;
            } catch (error) {
                console.error('Failed to fetch users:', error);
            }
        },

        async deleteUser(user) {
            const toast = useToast();

            try {
                await this.$http.delete(`/api/users/${user.id}`);
                this.users = this.users.filter(u => u.id !== user.id);
                toast.success(`Deleting ${user.user_name} user request has been sent successfully!`);
            } catch (error) {
                console.error('Failed to delete user:', error);
                toast.error('Failed to delete user. Please try again.');
            }
        },

        onSearchInput() {
            if (this.timeout) clearTimeout(this.timeout);
            this.timeout = setTimeout(() => {
                this.fetchUsers();
            }, 1000);
        },
    },
};
</script>
