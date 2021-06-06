<template>
    <bg-img>
        <breeze-validation-errors class="p-4 absolute top-4 right-0 bg-white transition ease-in-out duration-150" />

        <div class="w-full mx-auto sm:w-11/12 md:w-8/12 lg:w-1/2 max-w-xl py-16">
            <form @submit.prevent="submit" class="mx-8 px-8 py-8 bg-gray-50 bg-opacity-90 rounded shadow-md">
                
                <breeze-label class="pb-8 text-xl text-gray-600 text-center" for="" value="Register An Account" />

                <div>
                    <breeze-label for="first_name" value="First Name" />
                    <breeze-input id="first_name" type="text" class="mt-1 block w-full text-gray-600" v-model="form.first_name" required autofocus autocomplete="first_name" />
                </div>

                <div class="mt-4">
                    <breeze-label for="last_name" value="Last Name" />
                    <breeze-input id="last_name" type="text" class="mt-1 block w-full text-gray-600" v-model="form.last_name" required autocomplete="last_name" />
                </div>

                <div class="mt-4">
                    <breeze-label for="email" value="Email" />
                    <breeze-input id="email" type="email" class="mt-1 block w-full text-gray-600" v-model="form.email" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password" value="Password" />
                    <breeze-input id="password" type="password" class="mt-1 block w-full text-gray-600" v-model="form.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password_confirmation" value="Confirm Password" />
                    <breeze-input id="password_confirmation" type="password" class="mt-1 block w-full text-gray-600" v-model="form.password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <inertia-link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Already registered?
                    </inertia-link>

                    <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </breeze-button>
                </div>
            </form>
        </div>
    </bg-img>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from '@/Layouts/Guest'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    import BgImg from '@/Components/Background' 

    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,
            BgImg
        },

        props: {
            auth: Object,
            errors: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    role: 'user',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    }
</script>
