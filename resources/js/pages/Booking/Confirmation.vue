<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue'
import Stepper from '@/components/Stepper.vue'
import { Head, Link } from '@inertiajs/vue3'
import { route } from 'ziggy-js';
const props = defineProps({
    reference: String,
    summary: Object
})
</script>

<template>
    <AppLayout>
        <Head title="Confirmation" />
        <Stepper :steps="['Room Search','Rooms','Contact Information','Confirmation']" :current="3" />

        <div class="confirm">
            <h1>Booking Confirmed</h1>
            <p>Your reference is <b>{{ reference }}</b>.</p>

            <div class="card">
                <h3>{{ summary.room.title }}</h3>
                <p>Check-in: <b>{{ summary.check_in }}</b></p>
                <p>Check-out: <b>{{ summary.check_out }}</b></p>
                <p>Guests: <b>{{ summary.guests }}</b></p>
                <p>Total Paid: <b>${{ Number(summary.total_price).toFixed(2) }}</b></p>
            </div>

            <Link :href="route('dashboard')" class="btn">Go to Dashboard</Link>
        </div>
    </AppLayout>
</template>

<style scoped>
.confirm{max-width:600px;margin:auto;text-align:center}
.card{border:1px solid #eee;border-radius:12px;padding:16px;background:#fff;margin:16px 0;text-align:left}
.btn{display:inline-block;background:#111;color:#fff;text-decoration:none;padding:12px 16px;border-radius:10px;font-weight:800}
</style>
