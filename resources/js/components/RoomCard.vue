<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const props = defineProps({
    room: { type: Object, required: true },
    search: { type: Object, required: true },
})

function submit() {
    router.post(route('booking.contact'), {
        room_id: props.room.id,
        check_in: props.search.check_in,
        check_out: props.search.check_out,
        guests: props.search.guests,
    })
}
</script>

<template>
    <div class="card">
        <img :src="room.image_url" alt="" class="hero" />
        <div class="body">
            <h3>{{ room.title }}</h3>
            <p class="muted">Sleeps {{ room.capacity }}</p>
            <div class="row">
                <div class="price">
                    ${{ Number(room.price_per_night).toFixed(2) }} <span>/night</span>
                </div>
                <button type="button" class="btn" @click="submit">Book Room</button>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card{border:1px solid #eee;border-radius:12px;overflow:hidden;background:#fff;display:flex;flex-direction:column}
.hero{width:100%;aspect-ratio:4/3;object-fit:cover}
.body{padding:16px}
h3{margin:0 0 6px 0}
.muted{color:#666;margin:0 0 12px 0}
.row{display:flex;align-items:center;justify-content:space-between}
.price{font-weight:800;font-size:18px}
.price span{font-weight:400;color:#777}
.btn{background:#0b5;color:#fff;border:none;border-radius:8px;padding:10px 16px;font-weight:700;cursor:pointer}
.btn:hover{filter:brightness(.95)}
</style>
