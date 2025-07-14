<template>
    <div class="space-y-6">
        <!-- Add/Edit Notes Form -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <!-- Create Notes Form -->
            <div v-if="addnotes" class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-plus-circle text-blue-600 mr-2"></i>
                        Create New Note
                    </h2>
                </div>
                
                <form @submit.prevent="createNotes" class="space-y-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Title
                        </label>
                        <input
                            type="text"
                            name="title"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200"
                            placeholder="Enter note title..."
                            v-model="form.title"
                            required
                        />
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <textarea
                            name="description"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 resize-none"
                            placeholder="Enter note description..."
                            v-model="form.description"
                            required
                        ></textarea>
                    </div>
                    
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200 flex items-center"
                            :disabled="!form.title || !form.description"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Create Note
                        </button>
                    </div>
                </form>
            </div>

            <!-- Edit Notes Form -->
            <div v-if="editnotes" class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                        <i class="fas fa-edit text-green-600 mr-2"></i>
                        Edit Note
                    </h2>
                    <button
                        @click="cancelEdit"
                        class="text-gray-500 hover:text-gray-700 transition duration-200"
                    >
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form @submit.prevent="updateNotes(update_notes.id)" class="space-y-4">
                    <div>
                        <label for="edit_title" class="block text-sm font-medium text-gray-700 mb-1">
                            Title
                        </label>
                        <input
                            type="text"
                            name="edit_title"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200"
                            placeholder="Enter note title..."
                            v-model="update_notes.title"
                            required
                        />
                    </div>
                    
                    <div>
                        <label for="edit_description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>
                        <textarea
                            name="edit_description"
                            rows="4"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition duration-200 resize-none"
                            placeholder="Enter note description..."
                            v-model="update_notes.description"
                            required
                        ></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button
                            type="button"
                            @click="cancelEdit"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-md transition duration-200"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition duration-200 flex items-center"
                        >
                            <i class="fas fa-save mr-2"></i>
                            Update Note
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Notes List -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-semibold text-gray-800 flex items-center">
                    <i class="fas fa-list text-purple-600 mr-2"></i>
                    My Notes
                    <span class="ml-2 bg-purple-100 text-purple-800 text-sm font-medium px-2 py-1 rounded-full">
                        {{ notes.length }}
                    </span>
                </h2>
            </div>

            <!-- Empty State -->
            <div v-if="notes.length === 0" class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-sticky-note text-6xl"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-500 mb-2">No notes yet</h3>
                <p class="text-gray-400">Create your first note to get started!</p>
            </div>

            <!-- Notes Grid -->
            <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div
                    v-for="note in notes"
                    :key="note.id"
                    class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-lg p-5 hover:shadow-md transition-all duration-200 transform hover:-translate-y-1"
                >
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2">
                            {{ note.title }}
                        </h3>
                        <p class="text-gray-600 text-sm line-clamp-3">
                            {{ note.description }}
                        </p>
                    </div>
                    
                    <div class="flex justify-end space-x-2">
                        <button
                            @click="getNotes(note.id, note.title, note.description)"
                            class="bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-md text-sm transition duration-200 flex items-center"
                        >
                            <i class="fas fa-edit mr-1"></i>
                            Edit
                        </button>
                        <button
                            @click="confirmDelete(note.id)"
                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-sm transition duration-200 flex items-center"
                        >
                            <i class="fas fa-trash mr-1"></i>
                            Delete
                        </button>
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
        
        cancelEdit() {
            this.editnotes = false;
            this.addnotes = true;
            this.update_notes = {
                id: null,
                title: "",
                description: "",
            };
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
                    this.showErrorNotification("Failed to load notes.");
                });
        },
        
        getNotes(id, title, description) {
            this.editnotes = true;
            this.addnotes = false;
            this.update_notes.id = id;
            this.update_notes.title = title;
            this.update_notes.description = description;
        },

        async createNotes() {
            try {
                await axios.post("/api/notes/store", this.form);
                this.form = {
                    title: "",
                    description: ""
                };
                this.loadlist();
                this.showSuccessNotification("Note created successfully!");
            } catch (error) {
                console.error("Error creating note:", error);
                this.showErrorNotification("Failed to create note.");
            }
        },
        
        async updateNotes(id) {
            try {
                await axios.put("/api/notes/" + id, this.update_notes);
                this.cancelEdit();
                this.loadlist();
                this.showSuccessNotification("Note updated successfully!");
            } catch (error) {
                console.error("Error updating note:", error);
                this.showErrorNotification("Failed to update note.");
            }
        },
        
        async deleteNotes(id) {
            try {
                await axios.delete("/api/notes/" + id);
                this.loadlist();
                this.showSuccessNotification("Note deleted successfully!");
            } catch (error) {
                console.error("Error deleting note:", error);
                this.showErrorNotification("Failed to delete note.");
            }
        },
    },
};
</script>

<style scoped>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>