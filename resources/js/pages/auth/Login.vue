<script setup lang="ts">
import AuthenticatedSessionController from '@/actions/App/Http/Controllers/Auth/AuthenticatedSessionController';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/vue3';
import { LoaderCircle } from 'lucide-vue-next';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();
</script>

<template>
    <AuthBase >
        <Head title="Log in" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600 text-center">
            {{ status }}
        </div>

        <div class="auth-container">
            <div class="auth-card">
                <h1 class="auth-title">Log in to your account</h1>
                <p class="auth-description">Enter your email and password below to log in</p>

                <Form
                    v-bind="AuthenticatedSessionController.store.form()"
                    :reset-on-success="['password']"
                    v-slot="{ errors, processing }"
                    class="gap-6 flex flex-col"
                >
                    <div class="gap-6 grid">
                        <div class="gap-2 grid">
                            <Label for="email">Email address</Label>
                            <Input
                                id="email"
                                type="email"
                                name="email"
                                required
                                autofocus
                                :tabindex="1"
                                autocomplete="email"
                                placeholder="email@example.com"
                            />
                            <InputError :message="errors.email" />
                        </div>

                        <div class="gap-2 grid">
                            <div class="flex items-center justify-between">
                                <Label for="password">Password</Label>

                            </div>
                            <Input
                                id="password"
                                type="password"
                                name="password"
                                required
                                :tabindex="2"
                                autocomplete="current-password"
                                placeholder="Password"
                            />
                            <InputError :message="errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <Label for="remember" class="space-x-3 flex items-center">
                                <Checkbox id="remember" name="remember" :tabindex="3" />
                                <span>Remember me</span>
                            </Label>
                        </div>

                        <Button type="submit" class="mt-4 w-full" :tabindex="4" :disabled="processing">
                            <LoaderCircle v-if="processing" class="h-4 w-4 animate-spin" />
                            Log in
                        </Button>
                    </div>

                    <div class="text-sm text-muted-foreground text-center">
                        Don't have an account?
                        <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
                    </div>
                </Form>
            </div>
        </div>
    </AuthBase>
</template>
<style scoped>
/* Center the login card */
:global(body) {
    background: linear-gradient(135deg, #f8fafc, #e5e7eb);
    font-family:
        ui-sans-serif,
        system-ui,
        -apple-system,
        'Segoe UI',
        Roboto,
        'Helvetica Neue',
        Arial,
        sans-serif;
}

.auth-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 1rem;
}

.auth-card {
    width: 100%;
    max-width: 420px;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    padding: 2rem;
    animation: fadeIn 0.4s ease-in-out;
}

.auth-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 0.5rem;
    text-align: center;
}

.auth-description {
    font-size: 0.9rem;
    color: #6b7280;
    text-align: center;
    margin-bottom: 1.5rem;
}

/* Input styles */
input[type='email'],
input[type='password'] {
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    padding: 0.75rem;
    font-size: 0.95rem;
    transition:
        border-color 0.2s ease,
        box-shadow 0.2s ease;
}

input:focus {
    border-color: #0b5;
    box-shadow: 0 0 0 3px rgba(11, 85, 53, 0.2);
    outline: none;
}

/* Buttons */
button[type='submit'] {
    background: #0b5;
    color: #fff;
    padding: 0.75rem;
    border-radius: 0.5rem;
    font-weight: 600;
    font-size: 1rem;
    transition: background 0.2s ease;
}

button[type='submit']:hover {
    background: #0a4;
}

button[type='submit']:disabled {
    background: #9ca3af;
    cursor: not-allowed;
}

/* Links */
a {
    color: #0b5;
    font-weight: 500;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}

/* Error messages */
.error {
    font-size: 0.8rem;
    color: #dc2626;
    margin-top: 0.25rem;
}

/* Animation */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
