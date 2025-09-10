<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Stepper from '@/components/Stepper.vue';
import RoomCard from '@/components/RoomCard.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    rooms: Object, // paginator
    search: Object,
});
</script>

<template>
    <AppLayout>
        <Head title="Select Room" />
        <Stepper :steps="['Room Search', 'Rooms', 'Contact Information', 'Confirmation']" :current="1" />
        <div class="filters">
            <div>
                Check-in: <b>{{ search.check_in }}</b>
            </div>
            <div>
                Check-out: <b>{{ search.check_out }}</b>
            </div>
            <div>
                Guests: <b>{{ search.guests }}</b>
            </div>
        </div>

        <div class="grid">
            <RoomCard v-for="r in rooms.data" :key="r.id" :room="r" :search="search" />
        </div>
        <div class="pagination" v-if="rooms.links?.length">
            <Link
                v-for="l in rooms.links"
                :key="l.label"
                :href="l.url || ''"
                class="page-link"
                :class="{ active: l.active, disabled: !l.url }"
                v-html="l.label"
            />
        </div>
    </AppLayout>
</template>

<style scoped>
.filters {
    display: flex;
    gap: 16px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}
.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
}
.pagination {
    display: flex;
    gap: 8px;
    justify-content: center;
    margin-top: 16px;
}
.pagination a {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
}
.pagination a.active {
    background: #0b5;
    color: #fff;
    border-color: #0b5;
}
.pagination a.disabled {
    opacity: 0.4;
    pointer-events: none;
}
@media (max-width: 1000px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 640px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>
