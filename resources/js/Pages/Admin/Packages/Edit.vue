<template>
    <div>
        <Layout>
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="flex flex-col py-8">
                
                <div class="w-10/12 mx-auto pb-8 pt-5 bg-gray-200 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="w-4/5 mx-auto py-5">
                        <Label class="uppercase font-bold font-sans text-xl text-gray-100" value="Edit Package" />
                    </div>

                    <div class="my-5 border-b border-gray-300"></div>

                    <form @submit.prevent="submit" class="w-3/5 mx-auto py-5">
                        <div>
                            <Label for="name" value="Package Name" />
                            <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-4">
                            <Label for="price" value="Price" />
                            <Input id="price" type="number" class="mt-1 block w-full" v-model="form.price" required autocomplete="price" />
                        </div>

                        <div class="mt-4">
                            <Label for="photo" value="Include Photo" />
                            <div class="flex justify-around">
                                <div class="flex">
                                    <Label for="photo" value="Yes" class="mx-3" />
                                    <Input id="photo" type="radio" value="1" name="photo" :checked="advert_package.photo==1" class="mt-1 px-3" v-model="form.photo" />
                                </div>
                                <div class="flex">
                                    <Label for="photo" value="No" class="mx-3" />
                                    <Input id="photo" type="radio" value="0" name="photo" :checked="advert_package.photo==0" class="mt-1 px-3" v-model="form.photo" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <Label for="media" value="Include Media" />
                            <div class="flex justify-around">
                                <div class="flex">
                                    <Label for="media" value="Yes" class="mx-3" />
                                    <Input id="media" type="radio" value="1" name="media" :checked="advert_package.media==1" class="mt-1 px-3" v-model="form.media" />
                                </div>
                                <div class="flex">
                                    <Label for="media" value="No" class="mx-3" />
                                    <Input id="media" type="radio" value="0" name="media" :checked="advert_package.media==0" class="mt-1 px-3" v-model="form.media" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <Label for="ads_link" value="Include Ads Link" />
                            <div class="flex justify-around">
                                <div class="flex">
                                    <Label for="ads_link" value="Yes" class="mx-3" />
                                    <Input id="ads_link" type="radio" value="1" name="ads_link" :checked="advert_package.adslink==1" class="mt-1 px-3" v-model="form.adslink" />
                                </div>
                                <div class="flex">
                                    <Label for="ads_link" value="No" class="mx-3" />
                                    <Input id="ads_link" type="radio" value="0" name="ads_link" :checked="advert_package.adslink==0" class="mt-1 px-3" v-model="form.adslink" />
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <Label for="days" value="Duration in days" />
                            <Input id="days" type="text" class="mt-1 block w-full" v-model="form.days" required autocomplete="days" />
                        </div>

                        <div class="mt-4">
                            <Label for="series" value="Series" />
                            <Input id="series" type="text" class="mt-1 block w-full" v-model="form.series" required autocomplete="series" />
                        </div>

                        <div class="my-8"></div>

                        <div class="flex items-center justify-end mt-4">                            
                            <Button class="w-full" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Update Package
                            </Button>
                        </div>
                    </form>
                </div>
            </div>

        </Layout>
    </div>
</template>

<script>
import Layout from '@/Layouts/AdminLayout'
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
        ValidationErrors
    },

    props: {
        advert_package: Object
    },

    data() {
        return {
            form: this.$inertia.form({
                name: this.advert_package.name,
                price: this.advert_package.amount,
                photo: this.advert_package.photo,
                media: this.advert_package.media,
                adslink: this.advert_package.adslink,
                days: this.advert_package.days,
                series: this.advert_package.series
            })
        }
    },

    methods: {
        submit() {             
            this.$inertia.post('/admin/update-package/' + this.advert_package.id, this.form);
        }
    }
}
</script>
