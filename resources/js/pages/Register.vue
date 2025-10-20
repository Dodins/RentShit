<script setup lang="ts">
import { register } from '@/actions/App/Http/Controllers/AuthController';
import { loginpage } from '@/routes';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// If you prefer Wayfinder, uncomment and use form.submit(registerStore())
// import { store as registerStore } from "@/actions/App/Http/Controllers/RegisterController";

const showPw = ref(false);
const showPw2 = ref(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.submit(register());
};
</script>

<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-lg">
            <h1 class="text-center text-2xl font-semibold">Create Account</h1>
            <p class="mt-2 text-center text-sm text-gray-600">Join us in a few seconds.</p>

            <!-- Global errors -->
            <div v-if="Object.keys(form.errors).length" class="mt-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                <ul class="list-inside list-disc space-y-1">
                    <li v-for="(msg, key) in form.errors" :key="key">{{ msg }}</li>
                </ul>
            </div>

            <form @submit.prevent="submit" class="mt-6 space-y-4">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input
                        v-model="form.name"
                        type="text"
                        autocomplete="name"
                        required
                        class="mt-1 w-full rounded-lg border px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :class="form.errors.name ? 'border-red-400' : 'border-gray-300'"
                    />
                    <p v-if="form.errors.name" class="mt-1 text-xs text-red-600">{{ form.errors.name }}</p>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        required
                        class="mt-1 w-full rounded-lg border px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        :class="form.errors.email ? 'border-red-400' : 'border-gray-300'"
                    />
                    <p v-if="form.errors.email" class="mt-1 text-xs text-red-600">{{ form.errors.email }}</p>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <div class="relative mt-1">
                        <input
                            v-model="form.password"
                            :type="showPw ? 'text' : 'password'"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg border px-3 py-2 pr-12 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            :class="form.errors.password ? 'border-red-400' : 'border-gray-300'"
                        />
                        <button type="button" class="absolute inset-y-0 right-0 px-3 text-gray-500 hover:text-gray-700" @click="showPw = !showPw">
                            <span v-if="showPw">Hide</span><span v-else>Show</span>
                        </button>
                    </div>
                    <p v-if="form.errors.password" class="mt-1 text-xs text-red-600">{{ form.errors.password }}</p>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <div class="relative mt-1">
                        <input
                            v-model="form.password_confirmation"
                            :type="showPw2 ? 'text' : 'password'"
                            autocomplete="new-password"
                            required
                            class="w-full rounded-lg border px-3 py-2 pr-12 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            :class="form.errors.password_confirmation ? 'border-red-400' : 'border-gray-300'"
                        />
                        <button type="button" class="absolute inset-y-0 right-0 px-3 text-gray-500 hover:text-gray-700" @click="showPw2 = !showPw2">
                            <span v-if="showPw2">Hide</span><span v-else>Show</span>
                        </button>
                    </div>
                    <p v-if="form.errors.password_confirmation" class="mt-1 text-xs text-red-600">
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 py-2.5 font-medium text-white transition hover:bg-blue-700 disabled:opacity-50"
                    :disabled="form.processing"
                >
                    <span v-if="form.processing">Creating account…</span>
                    <span v-else>Register</span>
                </button>
            </form>

            <!-- Login link -->
            <p class="mt-6 text-center text-sm text-gray-600">
                Already have an account?
                <Link :href="loginpage.url()" class="font-medium text-blue-600 hover:underline">Login</Link>
            </p>
        </div>
    </div>
</template>
