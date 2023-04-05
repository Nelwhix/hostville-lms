<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';

const submit = () => {
    form.processing = true
    form.post(route('program.store'));

    const checkbox = document.getElementById('add-program');

    checkbox.checked = false;
};

const handleImage = (e) => {
    form.cover_image = e.target.files[0]
}

const form = useForm({
    title: '',
    description: '',
    duration: null,
    cover_image: null,
    processing: false
})

</script>

<template>
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
                <label for="add-program" class="btn bg-gray-400 border-gray-400">
                    Cancel
                </label>
                <PrimaryButton @click="submit" class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>
