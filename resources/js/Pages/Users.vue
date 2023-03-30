<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';
import TextInput from "@/Components/TextInput.vue";

defineProps({ users: Array })

</script>

<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>

            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                        <table class="table w-full">
                            <!-- head -->
                            <thead>
                            <tr>
                                <th></th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone no:</th>
                                <th>Email Address</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users" :key="user.id">
                                    <th>{{ user.id }}</th>
                                    <td>{{ user.firstName}}</td>
                                    <td>{{ user.lastName}}</td>
                                    <td>{{ user.phone }}</td>
                                    <td>{{ user.email }}</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
