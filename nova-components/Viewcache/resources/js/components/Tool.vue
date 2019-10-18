<template>
    <div>
        <heading class="mb-6">View Cache</heading>

        <card class="bg-gray-100 flex flex-col items-center justify-center"style="min-height: 300px">

            <h1 class="text-black-400 text-4xl text-90 font-medium mb-6">
                Enable Your Applications View Cache
            </h1>
            <button @click='activateCache' class="bg-black-200 text-black-600 font-semibold px-8 py-4 rounded-lg shadow-lg">Enable Cache</button>
        </card>
    </div>
</template>

<script>
export default {
   methods: {
       activateCache() {
           Nova.request().post('/nova-vendor/viewcache')
            .then(data => {
                alert('View Cache Successfully Activated');
            });
       }
   },
}
</script>

<style>
/* Scoped Styles */
</style>
