<template>
    <div v-if="$page.props.flash.success && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-green-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
        {{ $page.props.flash.success }}
        <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
    </div>
    <div v-if="$page.props.flash.warning && toast" class="cursor-pointer px-5 py-2 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-8 right-0 transition duration-500 ease-out focus:opacity-0" >                
        {{ $page.props.flash.warning }}
        <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
    </div>

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
                    <breeze-input id="email" type="email" class="mt-1 block w-full text-gray-600" v-model="form.email" required autocomplete="email" />
                </div>

                <div class="mt-4">
                    <breeze-label for="country" value="Country" />
                    <select v-model="form.country" required class="mt-1 block w-full text-gray-600 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm py-3">
                        <option value="" disabled>Select Country</option>
                        <option :value="country" v-for="country in countries" :key="country.id" class="">{{ country }}</option>
                    </select>
                </div>

                <div class="mt-4">
                    <breeze-label for="password" value="Password" />
                    <breeze-input id="password" type="password" class="mt-1 block w-full text-gray-600" v-model="form.password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <breeze-label for="password_confirmation" value="Confirm Password" />
                    <breeze-input id="password_confirmation" type="password" class="mt-1 block w-full text-gray-600" v-model="form.password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <breeze-label for="ref_code" value="Refferal Code" />
                    <breeze-input id="ref_code" type="text" class="mt-1 block w-full text-gray-600" v-model="form.ref_code" placeholder="Optional Refferal Code"/>
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
            countries: Array,
        },

        data() {
            return {
                toast: true,
                form: this.$inertia.form({
                    first_name: '',
                    last_name: '',
                    email: '',
                    country: '',
                    password: '',
                    password_confirmation: '',
                    role: 'user',
                    terms: false,
                    ref_code: ''
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
