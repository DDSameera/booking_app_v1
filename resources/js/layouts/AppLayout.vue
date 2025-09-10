<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { route } from 'ziggy-js';

const { props } = usePage()
const auth = props.auth || {}
</script>

<template>
    <div class="app min-h-screen flex flex-col">
        <header class="masthead">
            <div class="brand">
                <Link href="/">Hotel<span>Book</span></Link>
            </div>

            <nav class="nav">
                <Link href="/contact" class="hidden">Contact</Link>
                <template v-if="auth.user">
                    <Link :href="route('dashboard')">Dashboard</Link>
                    <Link href="/logout" method="post" as="button">Logout</Link>
                </template>
                <template v-else>
                    <Link href="/login">Admin Login</Link>
                    <Link href="/register">Admin Register</Link>
                </template>
            </nav>
        </header>

        <main class="container">
            <slot />
        </main>

        <footer class="footer">© {{ new Date().getFullYear() }} Hotel Booking Management System - Sameera Dananjaya Wijerathna </footer>
    </div>
</template>

<style scoped>
.masthead{display:flex;align-items:center;justify-content:space-between;padding:16px 24px;border-bottom:1px solid #eee;background:#fff;position:sticky;top:0;z-index:10}
.brand a{font-weight:800;text-decoration:none;font-size:20px;color:#111}
.brand span{color:#0b5}
.nav a, .nav button{margin-left:16px;text-decoration:none;color:#333;font-weight:600}
.container{max-width:1100px;margin:24px auto;padding:0 16px}
.footer{padding:32px 16px;color:#777;text-align:center;border-top:1px solid #eee;margin-top:40px}
</style>
