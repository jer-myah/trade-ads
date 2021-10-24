<template>
    <button :type="type" class="inline-flex items-center justify-center px-3 py-2 bg-red-300 rounded-md font-semibold text-xs text-white capitalize tracking-widest hover:bg-red-400 active:bg-red-500 focus:outline-none focus:border-red-500 focus:shadow-outline-red transition ease-out duration-200 transform hover:scale-110" >
        <slot />
    </button>
</template>

<style scoped>

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
