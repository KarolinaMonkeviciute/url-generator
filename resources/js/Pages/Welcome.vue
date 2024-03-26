<script setup>
import { reactive, defineProps } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    errors: Object,
    redirect: {
        type: String,
    },
});

const form = reactive({
    url: null,
});

function submit() {
    router.post(route("store"), form, {
        onSuccess: (bbb) => {
            console.log(props.redirect);
        },
    });
}
</script>

<template>
    <form @submit.prevent="submit">
        <label for="url">Url:</label>
        <input id="url" v-model="form.url" />
        <button type="submit">Submit</button>
        <div v-if="errors.url">{{ errors.url }}</div>
    </form>
    <div v-if="props.redirect">Your new URL: {{ props.redirect }}</div>
</template>
