<template>
    <div class="stepper">
        <div v-for="(s,i) in steps" :key="i" class="step" :class="{ active: i <= current }">
            <span class="index">{{ i+1 }}</span>
            <span class="label">{{ s }}</span>
        </div>
    </div>
</template>

<script setup lang="ts">
defineProps({
    steps: { type: Array, required: true },
    current: { type: Number, required: true }
})
</script>

<style scoped>
.stepper{display:flex;gap:16px;margin-bottom:16px;flex-wrap:wrap}
.step{display:flex;align-items:center;gap:8px;opacity:.6}
.step.active{opacity:1}
.index{width:24px;height:24px;border-radius:50%;display:inline-grid;place-items:center;background:#0b5;color:#fff;font-size:12px;font-weight:700}
.label{font-weight:700}
</style>
