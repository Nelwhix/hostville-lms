<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import 'vue-datepicker-next/index.css';
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";

defineProps({ lessons: Array })

const form = useForm({
    type: '',
    description: '',
    lesson_content: '',
    cover_image: null,
    video: null,
    processing: false
})

const handleImage = (e) => {
    form.cover_image = e.target.files[0]
}

const handleVideo = (e) => {
    form.video = e.target.files[0]
}

const submit = () => {
    form.processing = true
    form.post(route('lesson.store'));
};
</script>

<template>
    <Head title="Lessons" />

    <AuthenticatedLayout>
        <template #header>
            <div class="w-full flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lessons</h2>
                <label for="add-course" class="btn">
                    Add new lesson
                </label>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-3">
                    <div v-for="lesson in lessons" :key="lesson.id" class="card w-96 bg-base-100 shadow-xl">
                        <figure><img :src="`/storage/lessons/${lesson.cover_image}`" alt="lesson cover_image" /></figure>
                        <div class="card-body">
                            <p>{{ lesson.short_description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <input type="checkbox" id="add-course" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box">
                <h3>Add New Lesson</h3>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="type" value="Type" />

                        <TextInput
                            id="type"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.type"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.type" />
                    </div>

                    <div class="mt-4">
                        <InputLabel for="desc" value="Short description" />

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
                        <InputLabel for="desc" value="Content" />
                        <textarea v-model="form.lesson_content" class="textarea border-gray-300 w-full"></textarea>
                    </div>

                    <div class="mt-4">
                        <InputLabel for="cover_image" value="Cover Image" />

                        <input @change="handleImage" type="file" accept="image/png, image/jpeg" class="file-input w-full max-w-xs" />
                    </div>

                    <div class="mt-4">
                        <InputLabel value="Lesson Video" />

                        <input @change="handleVideo" type="file" accept="video/mp4" class="file-input w-full max-w-xs" />
                    </div>
                </form>

                <div class="modal-action">
                    <PrimaryButton @click="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Submit
                    </PrimaryButton>
                    <label for="add-course" class="btn">
                        Cancel
                    </label>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
