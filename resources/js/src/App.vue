<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">wittix</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item" v-if="isAuthenticated">
                            <router-link class="nav-link" to="/users">User List</router-link>
                        </li>
                        <li class="nav-item" v-if="isAuthenticated">
                            <router-link class="nav-link" to="/users/create">Create User</router-link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import {defineComponent, computed} from 'vue';

export default defineComponent({
    setup() {
        const isAuthenticated = computed(() => !!localStorage.getItem('auth_token'));

        return {
            isAuthenticated,
        };
    },
});
</script>

