<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import Stepper from '@/components/Stepper.vue';
import { Head, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import { route } from 'ziggy-js';



const props = defineProps({
    defaults: Object,
});

const form = reactive({
    check_in: props.defaults?.check_in,
    check_out: props.defaults?.check_out,
    guests: 1,
});

function submit() {
    router.get(route('rooms.list'), form);
}
</script>

<template>
    <AppLayout>
        <Head title="Room Search" />
        <Stepper :steps="['Room Search', 'Rooms', 'Contact Information', 'Confirmation']" :current="0" />
        <div class="panel">
            <h1>Find your stay</h1>
            <form @submit.prevent="submit" class="grid">
                <label>
                    <span>Check-in</span>
                    <input v-model="form.check_in" type="date" required />
                </label>
                <label>
                    <span>Check-out</span>
                    <input v-model="form.check_out" type="date" required />
                </label>
                <label>
                    <span>Guests</span>
                    <input v-model.number="form.guests" min="1" type="number" required />
                </label>
                <button class="cta">Search Rooms</button>
            </form>
        </div>
    </AppLayout>
</template>

<style scoped>
.panel {
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 24px;
    background: #fff;
}
h1 {
    margin: 0 0 16px 0;
}
.grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    align-items: end;
}
label {
    display: flex;
    flex-direction: column;
    gap: 8px;
}
span {
    font-weight: 700;
}
input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
}
.cta {
    justify-self: end;
    background: #111;
    color: #fff;
    padding: 12px 18px;
    border: none;
    border-radius: 10px;
    font-weight: 800;
    cursor: pointer;
}
@media (max-width: 800px) {
    .grid {
        grid-template-columns: 1fr;
    }
}
</style>
