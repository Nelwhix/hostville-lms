<template>
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
</template>
