<template>
    <button :type="type" class="inline-flex items-center justify-center px-3 py-2 bg-green-800 rounded-md font-semibold text-xs text-white capitalize tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:shadow-outline-green transition ease-out duration-200 transform hover:scale-110" >
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
