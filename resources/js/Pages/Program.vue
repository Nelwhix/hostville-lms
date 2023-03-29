<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps({ programs: Array })
</script>

<template>
    <Head title="Programs" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Programs</h2>
                <PrimaryButton>
                    Add new program
                </PrimaryButton>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <ul>

                    </ul>
                </div>
            </div>
        </div>

        <div class="modal">

        </div>
    </AuthenticatedLayout>
</template>
