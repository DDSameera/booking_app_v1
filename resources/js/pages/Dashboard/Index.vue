<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const props = defineProps({
    past: { type: Object, default: () => ({ data: [] }) },
    upcoming: { type: Object, default: () => ({ data: [] }) },
    cancelled: { type: Object, default: () => ({ data: [] }) },
});

const handleCancelBooking = (reference:any) => {
    if (!confirm('Are you sure you want to cancel this booking?')) return;


    router.delete(route('bookings.destroy',reference), {
        preserveScroll: true,
        onSuccess: () => {
            console.log('Booking cancelled:', reference);
        },
        onError: () => {
            alert('Failed to cancel booking');
        },
    });
};
</script>

<template>
    <AppLayout>
        <Head title="My Bookings" />

        <h1 class="title">List of All Bookings</h1>

        <!-- Upcoming bookings -->
        <section class="section">
            <h2 class="section-title">Upcoming</h2>
            <div v-if="upcoming.data.length" class="list">
                <div v-for="b in upcoming.data" :key="b.id" class="card">

                    <div class="info">
                        <h3>{{ b.room.title }}</h3>
                        <p>{{ b.check_in }} → {{ b.check_out }}</p>
                        <p>Guests: {{ b.guests }}</p>
                        <p>Total: ${{ Number(b.total_price).toFixed(2) }}</p>
                    </div>
                    <span class="badge upcoming">Upcoming</span>
                    <button class="danger-cta" @click="handleCancelBooking(b.reference)">Cancel</button>
                </div>
            </div>
            <p v-else class="empty">No upcoming bookings.</p>
        </section>

        <!-- Past bookings -->
        <section class="section">
            <h2 class="section-title">Past</h2>
            <div v-if="past.data.length" class="list">
                <div v-for="b in past.data" :key="b.id" class="card">
                    <div class="info">
                        <h3>{{ b.room.title }}</h3>
                        <p>{{ b.check_in }} → {{ b.check_out }}</p>
                        <p>Guests: {{ b.guests }}</p>
                        <p>Total: ${{ Number(b.total_price).toFixed(2) }}</p>
                    </div>
                    <span class="badge past">Past</span>
                </div>
            </div>
            <p v-else class="empty">No past bookings.</p>
        </section>



        <!-- Cancelled bookings -->
        <section class="section">
            <h2 class="section-title">Cancelled</h2>
            <div v-if="cancelled.data.length" class="list">
                <div v-for="b in cancelled.data" :key="b.id" class="card">

                    <div class="info">
                        <h3>{{ b.room.title }}</h3>
                        <p>{{ b.check_in }} → {{ b.check_out }}</p>
                        <p>Guests: {{ b.guests }}</p>
                        <p>Total: ${{ Number(b.total_price).toFixed(2) }}</p>
                    </div>
                    <span class="badge upcoming">Cancelled</span>

                </div>
            </div>
            <p v-else class="empty">No upcoming bookings.</p>
        </section>

    </AppLayout>
</template>

<style scoped>
.title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}
.section {
    margin-bottom: 2rem;
}
.section-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}
.list {
    display: grid;
    gap: 1rem;
}
.card {
    border: 1px solid #e5e7eb;
    border-radius: 0.75rem;
    padding: 1rem;
    background: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.info h3 {
    margin: 0 0 0.25rem;
    font-weight: 600;
}
.badge {
    padding: 0.3rem 0.6rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}
.badge.upcoming {
    background: #dcfce7;
    color: #166534;
}
.badge.past {
    background: #f3f4f6;
    color: #374151;
}
.empty {
    color: #6b7280;
    font-size: 0.9rem;
}
.danger-cta{
    margin-top:8px;
    background: #ff0101;
    color:#fff;border:none;border-radius:10px;padding:12px 16px;font-weight:800;cursor:pointer}


</style>
