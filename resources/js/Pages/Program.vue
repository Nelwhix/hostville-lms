<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/vue3';
import AddProgram from "@/Components/programs/AddProgram.vue";
import EditProgram from "@/Components/programs/EditProgram.vue";
import { ref } from "vue";

const props = defineProps({
    programs: Array,
    isAdmin: Boolean
})

const singleProgram = ref({
    id: 0,
    title: "",
    description: "",
    duration: "",
    cover_image: "",
    created_at: null,
    updated_at: null
})

const showEditModal = (id) => {
   const result = props.programs.filter((item) => item.id === id)
    singleProgram.value = result[0]

    document.getElementById('edit-program').checked = true;
}

const deleteProgram = () => {

}
</script>

<template>
    <Head title="Programs" ></Head>

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Programs</h2>
                <label for="add-program" class="btn">
                    Add new program
                </label>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-2 lg:grid-cols-3 gap-y-5">
                    <div v-for="program in programs" :key="program.id" class="card w-96 bg-base-100 shadow-xl">
                        <figure><img :src="`/storage/programs/${program.cover_image}`" alt="program cover_image" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ program.title }}</h2>
                            <p>{{ program.description }}</p>
                            <div v-if="isAdmin" class="card-actions justify-end">
                                <button @click="showEditModal(program.id)" class="btn bg-gray-400 border-gray-400">Edit</button>
                                <button @click="deleteProgram(program.id)" class="btn bg-gray-800 border-gray-800">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <EditProgram :program="singleProgram" />
            <AddProgram />
        </div>
    </AuthenticatedLayout>
</template>
