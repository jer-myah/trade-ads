<template>
    <bg-img>
        <breeze-validation-errors class="p-4 absolute top-4 right-0 bg-white transition ease-in-out duration-150" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        
        <div class="w-full mx-auto sm:w-11/12 md:w-8/12 lg:w-1/2 max-w-xl py-16" >
            <form @submit.prevent="submit" class="mx-8 px-8 py-8 bg-gray-50 bg-opacity-90 rounded shadow-md">
                
                <breeze-label class="pb-8 text-xl text-gray-600 text-center" for="" value="Account Login" />

                <div>
                    <breeze-label for="email" value="Email" />
                    <breeze-input id="email" type="email" class="mt-1 block w-full text-gray-600" v-model="form.email" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password" value="Password" />
                    <breeze-input id="password" type="password" class="mt-1 block w-full text-gray-600" v-model="form.password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label class="flex items-center">
                        <breeze-checkbox name="remember" v-model:checked="form.remember" />
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Forgot your password?
                    </inertia-link>

                    <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Log in
                    </breeze-button>
                </div>
            </form>
        </div>

    </bg-img>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from "@/Layouts/Guest"
    import BreezeInput from '@/Components/Input'
    import BreezeCheckbox from '@/Components/Checkbox'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import BgImg from '@/Components/Background'

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            BreezeInput,
            BreezeCheckbox,
            BreezeLabel,
            BreezeValidationErrors,
            BgImg
        },

        props: {
            auth: Object,
            canResetPassword: Boolean,
            errors: Object,
            status: String,
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('login'), {
                    onFinish: () => this.form.reset('password'),
                })
            }
        }
    }
</script>
