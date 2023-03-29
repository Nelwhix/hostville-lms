<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';
import TextInput from "@/Components/TextInput.vue";

defineProps({ programs: Array })

const form = useForm({
    title: '',
    description: '',
    duration: null,
    cover_image: null,
    processing: false
})

const handleImage = (e) => {
    form.cover_image = e.target.files[0]
}

const submit = () => {
    form.processing = true
    form.post(route('program.store'));
};
</script>

<template>
    <Head title="Programs" />

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
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-3">
                    <div v-for="program in programs" class="card w-96 bg-base-100 shadow-xl">
                        <figure><img :src="`/storage/programs/${program.cover_image}`" alt="program cover_image" /></figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ program.title }}</h2>
                            <p>{{ program.description }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="checkbox" id="add-program" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3>Add New Program</h3>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="title" value="Title" />

                        <TextInput
                            id="title"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.title"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="desc" value="Description" />

                        <TextInput
                            id="desc"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.description"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.description" />
                    </div>

                    <div class="mt-4">
                        <InputLabel value="Duration" />

                        <DatePicker v-model:value="form.duration" range />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="cover_image" value="Cover Image" />

                        <input @change="handleImage" type="file" accept="image/png, image/jpeg" class="file-input w-full max-w-xs" />
                    </div>
                </form>

                <div class="modal-action">
                    <PrimaryButton @click="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Submit
                    </PrimaryButton>
                    <label for="add-program" class="btn">
                       Cancel
                    </label>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
