<script setup lang="ts">
import AppLayout from '@/Layouts/AppLayout.vue'
import { Head } from '@inertiajs/vue3'

const props = defineProps({
    bookings: Object
})
</script>

<template>
    <AppLayout>
        <Head title="My Bookings" />
        <h1>My Bookings</h1>
        <div v-if="bookings.data.length === 0" class="empty">No bookings yet.</div>

        <div class="list">
            <div v-for="b in bookings.data" :key="b.id" class="row">
                <div class="main">
                    <div class="title">
                        <strong>{{ b.room.title }}</strong>
                        <span class="ref">Ref: {{ b.reference }}</span>
                    </div>
                    <div class="meta">
                        <span>{{ b.check_in }} → {{ b.check_out }}</span>
                        <span>Guests: {{ b.guests }}</span>
                        <span>Status: <b :class="b.status">{{ b.status }}</b></span>
                        <span>Total: ${{ Number(b.total_price).toFixed(2) }}</span>
                    </div>
                </div>
                <div class="actions">
                    <form v-if="b.status === 'confirmed'" :action="route('booking.cancel', b.reference)" method="post">
                        <input type="hidden" name="_token" :value="(document.querySelector('meta[name=csrf-token]')?.content)||''" />
                        <button class="danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="pagination" v-if="bookings.links?.length">
            <a v-for="l in bookings.links" :key="l.label" :href="l.url || '#'" :class="{active: l.active, disabled: !l.url}" v-html="l.label"></a>
        </div>
    </AppLayout>
</template>

<style scoped>
h1{margin-bottom:12px}
.empty{color:#777}
.list{display:grid;gap:12px}
.row{display:flex;justify-content:space-between;align-items:center;border:1px solid #eee;border-radius:12px;padding:12px;background:#fff}
.title{display:flex;gap:12px;align-items:center}
.ref{color:#777}
.meta{display:flex;gap:16px;color:#555;flex-wrap:wrap}
.actions .danger{background:#d33;color:#fff;border:none;padding:8px 12px;border-radius:8px;font-weight:700;cursor:pointer}
b.confirmed{color:#0b5}
b.cancelled{color:#d33}
.pagination{display:flex;gap:8px;justify-content:center;margin-top:16px}
.pagination a{padding:8px 12px;border:1px solid #ddd;border-radius:8px;text-decoration:none;color:#333}
.pagination a.active{background:#0b5;color:#fff;border-color:#0b5}
.pagination a.disabled{opacity:.4;pointer-events:none}
</style>
