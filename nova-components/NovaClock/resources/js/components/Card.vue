<template>
    <card class="flex flex-col items-center justify-center">
        <div class="px-3 py-3">
            <digital-clock :blink='card.blink' :twelveHour='card.twelveHour' :displaySeconds='card.withSeconds' class="font-bold text-5xl shadow-lg px-8 py-4 rounded-full" />
        </div>
    </card>
</template>

<script>
import DigitalClock from "vue-digital-clock";

export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    components: {
        DigitalClock
    },

    mounted() {
        //
    },
}
</script>
