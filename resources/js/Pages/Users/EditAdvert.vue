<template>
    <div>
        <validation-errors></validation-errors>

        <div v-if="$page.props.flash.warning && toast" class="cursor-pointer p-5 shadow-lg rounded bg-yellow-200 text-gray-600 absolute top-0 right-0 transition duration-500 ease-out focus:opacity-0" >                
            {{ $page.props.flash.warning }}
            <button @click="toast=false" class="p-3 focus:outline-none text-lg">x</button>
        </div>

        <teleport to="#modal" v-if="image_error_modal">
            <div @click.self="image_error_modal = false" class="min-w-screen h-screen animated fadeIn faster  fixed  left-0 top-0 flex justify-center items-center inset-0 z-50 outline-none focus:outline-none"  style="background: rgba(0,0,0,.2);" id="modal-id">
                <div class="w-full  max-w-lg p-5 relative mx-auto my-auto rounded-xl shadow-lg  bg-white ">
                    <!--content-->
                    <div class="">
                        <!--body-->
                        <div class="text-center p-5 flex-auto justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-red-500 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-red-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <h2 class="text-xl text-gray-600 font-bold py-4 ">Invalid Input</h2>
                            <p class="text-sm text-gray-500 px-8">
                                Input field cannot be empty. Fill and retry...
                            </p>    
                        </div>
                        <!--footer-->
                        <div class="p-3  mt-2 text-center space-x-4 md:block">
                            <button @click="image_error_modal = false" class="mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:shadow-lg hover:bg-gray-100 focus:outline-none transition ease-out duration-200 transform hover:scale-110">
                                Dismiss
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </teleport>

        <Layout>
            <!-- <div class="w-full border-b"></div> -->

            <!--  -->
            <div class="flex flex-col py-8">
                
                <div class="w-10/12 mx-auto pb-8 pt-5 bg-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="w-4/5 mx-auto py-5">
                        <Label class="uppercase font-bold font-sans text-xl text-gray-100" value="Update Advert" />
                    </div>

                    <div class="my-5 border-b border-gray-300"></div>

                    <form v-if="!edit_image" @submit.prevent="update" class="w-3/5 mx-auto py-5">

                        <div class="mt-4">
                            <Label for="plan" value="Plan" />
                            <Input disabled :value="plan.name" type="text" class="mt-1 block w-full" />
                        </div>
                    
                        <div class="mt-4">
                            <Label for="plan" value="Category" />
                            <Input disabled :value="category.name" type="text" class="mt-1 block w-full" />
                        </div>

                        <div class="mt-4">
                            <Label for="title" value="Advert Title" />
                            <Input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autocomplete="title" />
                        </div>

                        <div class="mt-4">
                            <Label for="description" value="Description" />
                            <textarea id="description" class="w-full border-gray-300 focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 rounded-md shadow-sm py-3" v-model="form.description" required autocomplete="description"></textarea>
                        </div>

                        <div class="mt-4">
                            <Label for="phone" value="Contact Phone Number" />
                            <Input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" required autocomplete="phone" />
                        </div> 

                        <div class="my-8"></div>

                        <div class="flex items-center justify-center mt-4">                            
                            <Button class="w-full focus:outline-none" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="w-11/12 mx-auto">Update Advert</span>
                            </Button>
                        </div>

                        <div class="my-4">
                            <span @click="edit_image = true" class="text-sm text-gray-500 hover:text-gray-600 cursor-pointer">Update Image</span>
                        </div>
                    </form>

                    <form v-else @submit.prevent="updateImage()" class="w-3/5 mx-auto py-5">

                        <div class="mt-5">
                            <Label for="image" value="First Image" />
                            <Input id="image" type="file" @input="image_form.image = $event.target.files[0]" class="mt-1 block w-full" />
                        </div>

                        <div class="mt-5">
                            <Label for="image1" value="Second Image" />
                            <Input id="image1" type="file" @input="image_form.image_1 = $event.target.files[0]" class="mt-1 block w-full" />
                        </div>

                        <div class="mt-5">
                            <Label for="image2" value="Third Image" />
                            <Input id="image2" type="file" @input="image_form.image_2 = $event.target.files[0]" class="mt-1 block w-full" />
                        </div>

                        <div class="mt-5">
                            <Label for="video" value="Optional Video" />                            
                            <Input id="video" type="file" @input="image_form.video = $event.target.files[0]" class="mt-1 block w-full" accept="video/.mpeg" />
                        </div>

                        <div class="my-8"></div>

                        <div class="flex items-center justify-center mt-4">                            
                            <Button class="w-full focus:outline-none" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                <span class="w-11/12 mx-auto">Update Advert Image</span>
                            </Button>
                        </div>

                        <div class="my-4">
                            <span @click="edit_image = false" class="text-sm text-gray-500 hover:text-gray-600 cursor-pointer">Update Advert Information</span>
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
        advert: Object,
        category: Object,
        plan: Object
    },

    data() {
        return {
            image_error_modal: false,
            show_form: false,
            toast: true,
            edit_image: false,
            form: this.$inertia.form({
                title: this.advert.title,
                description: this.advert.description,
                phone: this.advert.phone_num,
            }),
            image_form: this.$inertia.form({
                image: '',
                image_1: '',
                image_2: '',
                video: '',
            }),
        }
    },
    methods: {
        
        update() {
            this.$inertia.post('/user/update-advert/'+this.advert.id, this.form);
        },

        updateImage() {
            if(this.image_form.image != '' || this.image_form.image_1 != '' || this.image_form.image_2 != '' || this.image_form.video != ''){ 
                this.$inertia.post('/user/update-advert-image/'+this.advert.id, this.image_form);
            }else{
                this.image_error_modal = true;
            }
        }
    }
}
</script>
