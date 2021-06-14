<template>
    <div>
        <validation-errors></validation-errors>

        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer p-5 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-0 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <Layout>
            
            <div v-if="! show_form" class="container flex flex-wrap pt-4 pb-10 m-auto mt-6 md:mt-15 lg:px-12 xl:px-16">
                <div class="w-full px-0 lg:px-4">
                    <h2 class="px-12 text-base font-bold text-center md:text-2xl text-gray-700">
                        Choose your plan
                    </h2>
                    <p class="py-1 text-lg text-center text-gray-700 mb-10">
                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                    </p>
                    <div class="flex flex-wrap items-center justify-center py-4 pt-0">
                        
                        <div class="w-full p-4 md:w-1/2 lg:w-1/4 transition ease-in-out duration-200 transform hover:scale-110" v-for="(advertPackage) in advertPackages" :key="advertPackage.id"> 
                            <label class="flex flex-col rounded-lg shadow-lg relative cursor-pointer hover:shadow-2xl">
                                <div class="w-full px-4 py-8 rounded-t-lg bg-yellow-500">
                                    <h3 class="mx-auto text-base font-semibold text-center underline text-white group-hover:text-white">
                                        {{ advertPackage.name }}
                                    </h3>
                                    <p class="text-5xl font-bold text-center text-white">
                                        ${{ advertPackage.amount }}<span class="text-3xl"></span>
                                    </p>
                                    <p class="text-xs text-center uppercase text-white">
                                        {{ advertPackage.days }} Days
                                    </p>
                                </div>
                                <div class="flex flex-col items-center justify-center w-full h-full py-6 rounded-b-lg bg-yellow-700" >
                                    <p class="text-lg text-white"> Series: {{ advertPackage.series }} Hours  </p>
                                    <p class="text-md text-white" v-if="advertPackage.photo"> Includes Photo </p>
                                    <p class="text-md text-white" v-else> Excludes Photo </p>
                                    <p class="text-md text-white" v-if="advertPackage.media"> Includes Media </p>                                    
                                    <p class="text-md text-white" v-else> Excludes media </p>
                                    <p class="text-md text-white" v-if="advertPackage.adslink"> Includes AdsLink </p>
                                    <p class="text-md text-white" v-else> Excludes AdsLink </p>

                                    <button @click="form.package_id = advertPackage.id, form.package_name = advertPackage.name, show_form=true" class="w-5/6 py-2 mt-2 font-semibold text-center uppercase bg-white focus:outline-none focus:bg-yellow-400 focus:text-yellow-50 rounded text-gray-500">
                                        Select
                                    </button>
                                </div>
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <!-- <div class="w-full border-b"></div> -->

            <!-- This example requires Tailwind CSS v2.0+ -->
            <div v-if="show_form" class="flex flex-col py-8">
                
                <div class="w-10/12 mx-auto pb-8 pt-5 bg-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="w-4/5 mx-auto py-5">
                        <Label class="uppercase font-bold font-sans text-xl text-gray-100" value="Create Advert" />
                    </div>

                    <div class="my-5 border-b border-gray-300"></div>

                    <form @submit.prevent="submit" class="w-3/5 mx-auto py-5">

                        <div class="mt-4">
                            <Label for="plan" value="Plan Selected" />
                            <Input disabled :value="form.package_name" type="text" class="mt-1 block w-full" />
                        </div>
                    
                        <select v-model="form.selected" class="mt-4 border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm py-3" required>
                            <option disabled value="">Select Advert Category</option>
                            <option v-for="cat in advertCategories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
                        </select>

                        <div class="mt-4">
                            <Label for="title" value="Advert Title" />
                            <Input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autocomplete="title" />
                        </div>

                        <div class="mt-4">
                            <Label for="description" value="Description" />
                            <textarea id="description" class="w-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm py-3" v-model="form.description" required autocomplete="description"></textarea>
                        </div>

                        <div class="mt-5">
                            <Label for="image" value="Image" />
                            <Input id="image" type="file" @input="form.image = $event.target.files[0]" class="mt-1 block w-full" required />
                        </div>

                        <div class="mt-5">
                            <Label for="video" value="Optional Video" />
                            <!-- <Input id="video" type="file" @input="form.video = $event.target.files[0]" class="mt-1 block w-full" v-bind="form.video" /> -->
                            <Input id="video" type="file" @input="form.video = $event.target.files[0]" class="mt-1 block w-full" accept="video/.mpeg" />
                        </div>

                        <div class="mt-4">
                            <Label for="phone" value="Contact Phone Number" />
                            <Input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="phone" />
                        </div> 

                        <div class="my-8"></div>

                        <div class="flex items-center justify-center mt-4">                            
                            <Button class="w-full focus:outline-none" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="w-11/12 mx-auto">Place Advert</span>
                            </Button>
                        </div>
                    </form>
                </div>
            </div>

        </Layout>
    </div>
</template>

<script>
import Layout from '@/Layouts/Authenticated'
import Button from '@/Components/Button'
import Input from '@/Components/Input'
import Label from '@/Components/Label'
import ValidationErrors from '@/Components/ValidationErrors'

export default {
    components: {
        Layout,
        Button,
        Input,
        Label,
        ValidationErrors,
    },

    props: {
        advertPackages: Object,
        advertCategories: Object,
    },

    data() {
        return {
            show_form: false,
            toast: true,
            form: this.$inertia.form({
                selected: '',
                package_id: '',
                package_name: '',
                category: '',
                title: '',
                description: '',
                phone: '',
                image: '',
                video: '',
            }),

        }
    },
    methods: {
        
        submit() {
            this.$inertia.post('/user/place-advert', this.form);
        }
    }
}
</script>
