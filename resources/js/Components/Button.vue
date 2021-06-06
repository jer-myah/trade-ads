<template>
    <button :type="type" class="inline-flex items-center justify-center px-6 py-3 bg-green-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green transition ease-in-out duration-150" >
        <slot />
    </button>
</template>

<style scoped>
button {
    background-color: #c48f52ce;
}

button:hover {
    background-color: #AD8B63;
}
</style>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
