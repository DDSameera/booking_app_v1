<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import Stepper from '@/components/Stepper.vue'
import { Head, useForm } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const props = defineProps<{
    room: any
    booking: { room_id?: number; check_in: string; check_out: string; guests: number }
    total: number
}>()

// Reactive form (Inertia)
const form = useForm({
    room_id: props.booking?.room_id ?? props.room.id,
    check_in: props.booking.check_in,
    check_out: props.booking.check_out,
    guests: props.booking.guests,
    full_name: '',
    email: '',
    phone: '',
})

function submit() {
    form.post(route('booking.store'), { preserveScroll: true })
}
</script>

<template>
    <AppLayout>
        <Head title="Contact Information" />
        <Stepper :steps="['Room Search','Rooms','Contact Information','Confirmation']" :current="2" />

        <div class="layout">
            <section class="left">
                <h2>Contact Information</h2>

                <!-- No manual CSRF, Inertia handles it -->
                <form @submit.prevent="submit" class="form">
                    <!-- keep booking context as hidden OR leave as state only -->
                    <input type="hidden" name="room_id" :value="form.room_id" />
                    <input type="hidden" name="check_in" :value="form.check_in" />
                    <input type="hidden" name="check_out" :value="form.check_out" />
                    <input type="hidden" name="guests" :value="form.guests" />

                    <label>Full name
                        <input v-model="form.full_name" required />
                        <small v-if="form.errors.full_name" class="err">{{ form.errors.full_name }}</small>
                    </label>

                    <label>Email
                        <input v-model="form.email" type="email" required />
                        <small v-if="form.errors.email" class="err">{{ form.errors.email }}</small>
                    </label>

                    <label>Phone (optional)
                        <input v-model="form.phone" />
                        <small v-if="form.errors.phone" class="err">{{ form.errors.phone }}</small>
                    </label>

                    <button class="cta" :disabled="form.processing">
                        {{ form.processing ? 'Submitting…' : 'Confirm Booking' }}
                    </button>
                </form>
            </section>

            <aside class="right">
                <img :src="room.image_url" alt="" />
                <div class="summary">
                    <h3>{{ room.title }}</h3>
                    <p>Check-in: <b>{{ form.check_in }}</b></p>
                    <p>Check-out: <b>{{ form.check_out }}</b></p>
                    <p>Guests: <b>{{ form.guests }}</b></p>
                    <hr />
                    <p class="total">Total: <b>${{ Number(total).toFixed(2) }}</b></p>
                </div>
            </aside>
        </div>
    </AppLayout>
</template>

<style scoped>
.layout{display:grid;grid-template-columns:2fr 1fr;gap:24px}
.form{display:grid;gap:12px}
label{display:grid;gap:6px}
input{padding:10px;border:1px solid #ddd;border-radius:8px}
.err{color:#c00}
.cta{margin-top:8px;background:#0b5;color:#fff;border:none;border-radius:10px;padding:12px 16px;font-weight:800;cursor:pointer}
.right img{width:100%;border-radius:12px;margin-bottom:12px}
.summary{border:1px solid #eee;border-radius:12px;padding:12px;background:#fff}
.total{font-size:18px}
@media (max-width:900px){.layout{grid-template-columns:1fr}}
</style>
