<template>
    <div class="container mb-5 mt-5 flex flex-col m-10">
        <div class="row">
            <div class="col-md-12" v-if="addnotes">
                <h2 class="text-xl mb-4 font-semibold">Create Notes</h2>
                <form v-on:submit.prevent="createNotes">
                    <div class="mb-4">
                        <label
                            for="title"
                            class="block text-sm font-medium text-gray-700"
                            >Title</label
                        >
                        <input
                            type="text"
                            name="title"
                            class="form-input mt-1 block w-6/12 rounded-md border-gray-300 h-8 border-2 p-1"
                            placeholder="Enter Title"
                            v-model="form.title"
                        />
                    </div>
                    <div class="mb-4">
                        <label
                            for="description"
                            class="block text-sm font-medium text-gray-700"
                            >Description</label
                        >
                        <input
                            type="text"
                            name="description"
                            class="form-input mt-1 block rounded-md w-6/12 border-2 p-1 h-10"
                            placeholder="Enter Description"
                            v-model="form.description"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block mb-5"
                    >
                        Submit
                    </button>
                </form>
            </div>
            <div class="col-md-12" v-if="editnotes">
                <h2 class="text-xl mb-4 font-semibold">Edit Notes</h2>
                <form v-on:submit.prevent="updateNotes(update_notes.id)">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                                >Title</label
                            >
                            <input
                                type="text"
                                name="title"
                                class="form-input mt-1 block rounded-md w-6/12 border-2 p-1 h-10"
                                placeholder="Enter Title"
                                v-model="update_notes.title"
                            />
                        </div>
                        <div>
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                                >Description</label
                            >
                            <input
                                type="text"
                                name="description"
                                class="form-input mt-1 block rounded-md w-6/12 border-2 p-1 h-10"
                                placeholder="Enter Description"
                                v-model="update_notes.description"
                            />
                        </div>
                    </div>
                    <input type="hidden" name="id" v-model="update_notes.id" />
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded inline-block mt-4 mb-5"
                    >
                        Update
                    </button>
                </form>
            </div>

            <div
                class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-200 p-5 mb-5 rounded-lg"
            >
                <div
                    v-for="note in notes"
                    :key="note.id"
                    class="bg-white p-4 border border-gray-300 rounded-md"
                >
                    <div class="mb-2">
                        <strong class="block text-lg">{{ note.title }}</strong>
                        <span class="text-gray-700">{{
                            note.description
                        }}</span>
                    </div>
                    <div class="flex justify-end">
                        <a
                            href="#"
                            class="bg-green-700 hover:bg-green-800 text-white py-1 px-3 rounded inline-block mr-2"
                            @click="
                                getNotes(note.id, note.title, note.description)
                            "
                            >Edit</a
                        >
                        <a
                            href="#"
                            class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded inline-block"
                            @click="confirmDelete(note.id)"
                            >Delete</a
                        >
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-default.css";


export default {
    mounted() {
        this.loadlist();
    },
    data() {
        return {
            notes: [],
            editnotes: false,
            addnotes: true,
            form: {
                title: "",
                description: "",
            },
            update_notes: {
                id: null,
                title: "",
                description: "",
            },
        };
    },

    methods: {
        confirmDelete(id) {
            if (confirm("Are you sure you want to delete this note?")) {
                this.deleteNotes(id);
            }
        },
        showSuccessNotification(message) {
            const toast = useToast();
            toast.success(message);
        },
        showErrorNotification(message) {
            const toast = useToast();
            toast.error(message);
        },
        loadlist() {
            axios
                .get("/api/notes")
                .then((result) => {
                    console.log(result);
                    this.notes = result.data;
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        getNotes(id, title, description) {
            (this.editnotes = true), (this.addnotes = false);
            console.log(id, title, description);
            this.update_notes.id = id;
            this.update_notes.title = title;
            this.update_notes.description = description;
        },

        async createNotes() {
            try {
                await axios.post("/api/notes/store", this.form)
                this.form = {
                    title: "",
                    description: ""
                };
                this.loadlist();
                this.showSuccessNotification("Notes create successfully!");
            }
            catch (error) {
                console.error("Error create note:", error);
                this.showErrorNotification("Failed to create notes.");
            }

        },
        async updateNotes(id) {
            try {
                await axios.put("/api/notes/" + id, this.update_notes)
                this.editnotes = false;
                this.addnotes = true;
                this.loadlist();
                this.showSuccessNotification("Notes updated successfully!");
            } catch (error) {
                console.error("Error updated note:", error);
                this.showErrorNotification("Failed to updated notes.");
            }
        },
        async deleteNotes(id) {
            try {
                await axios.delete("/api/notes/" + id);
                this.loadlist();
                this.showSuccessNotification("Notes deleted successfully!");
            } catch (error) {
                console.error("Error deleting note:", error);
                this.showErrorNotification("Failed to delete notes.");
            }
        },
    },
};
</script>