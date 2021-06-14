<template>
    <div v-if="hasErrors && toast" class="p-5 shadow-lg rounded bg-gray-200 text-gray-600 absolute top-30 right-0 transition-opacity duration-1000 ease-out opacity-100">
        <div class="font-medium text-red-600">Whoops! Something went wrong. <span @click="toast= !toast" class="text-lg px-3 cursor-pointer">x</span></div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            errors() {
                this.toast = true;
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },
        },
        data() {
            return {
                toast: false
            }
        }       
    }
</script>
