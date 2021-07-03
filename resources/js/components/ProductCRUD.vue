<template>
    <div
        class="sm:max-w-xl w-full flex-grow mx-auto p-5 shadow rounded-md overflow-hidden lg:max-w-5xl bg-white flex flex-col">

        <template>

            <div class="flex items-center justify-start mb-5">
                <inertia-link
                    href="/merchant/inventory"
                    class="inline-flex items-center justify-center h-12 px-6 font-medium tracking-wide text-gray-600 transition duration-200 rounded hover:text-purple-700 focus:shadow-outline focus:outline-none">
                    < Back to Inventory
                </inertia-link
                >
            </div>
            <h1
                class="max-w-lg  mx-auto mb-6 text-3xl font-extrabold tracking-tighter text-center text-cool-gray-700 sm:text-4xl sm:leading-none"
            >
                {{ header }}
            </h1>

            <div class="flex flex-col justify-center items-center">
                <input type="file" class="hidden"
                       ref="photo"
                       accept="image/*"
                       @change="updatePhotoPreview">

                <button type="button" class="mt-2 block" v-show="! photoPreview" @click.prevent="selectNewPhoto">
                    <img src="/images/icon-product-5.jpg" alt="Product Image"
                         class="rounded-md h-[250px] w-screen max-w-md sm:max-w-lg object-contain">
                </button>

                <button type="button" class="mt-2 block" v-show="photoPreview" @click.prevent="selectNewPhoto">
                        <span class="block rounded-md h-[250px] w-screen max-w-md sm:max-w-lg transition duration-200 ease-in-out hover:brightness-105"
                              :style="'background-size: contain; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                        </span>
                </button>

                <jet-secondary-button class="mt-2" type="button" @click.native.prevent="selectNewPhoto">
                    Select A New Product Photo
                </jet-secondary-button>


                <jet-input-error :message="form.errors.photo" class="mt-2"/>
            </div>

            <div class="max-w-lg w-full mx-auto">

                <jet-label for="name" value="Name"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name"
                           placeholder="Americana Foul Medames"/>
                <jet-input-error :message="form.errors.name" class="mt-2"/>

                <jet-label class="mt-3" for="description" value="Description"/>
                <textarea id="description" rows="5"
                          placeholder="A can of Americana Foul."
                          class="border-gray-300 mt-1 resize-none w-full focus:border-teal-300 focus:ring focus:ring-teal-200 focus:ring-opacity-50 rounded-md shadow-sm"
                          v-model="form.description"></textarea>
                <jet-input-error :message="form.errors.description" class="mt-2"/>

                <jet-label class="mt-3" for="barcode" value="Barcode"/>
                <jet-input id="barcode" type="number" class="mt-1 block w-full" min="1" v-model="form.barcode" placeholder="60045007406"/>
                <jet-input-error :message="form.errors.barcode" class="mt-2"/>

                <jet-label class="mt-3" for="qty" value="Quantity"/>
                <jet-input id="qty" type="number" class="mt-1 block w-full" min="1" v-model="form.qty" placeholder="1"/>
                <jet-input-error :message="form.errors.qty" class="mt-2"/>

                <jet-label class="mt-3" for="weight" value="Weight"/>
                <jet-input id="weight" type="number" class="mt-1 block w-full" min="0" v-model="form.weight"
                           placeholder="0"/>
                <jet-input-error :message="form.errors.weight" class="mt-2"/>

                <jet-label class="mt-3" for="price" value="Price"/>
                <jet-input id="price" type="number" class="mt-1 block w-full" min="0" v-model="form.price"
                           placeholder="0"/>
                <jet-input-error :message="form.errors.price" min="0" class="mt-2"/>
                <div class="flex w-full justify-center items-center pt-5">

                    <jet-button type="button" @click.native.prevent="submit">
                        {{ button }}
                    </jet-button>

                    <jet-danger-button v-if="deletable" class="ml-5" type="button"
                                       @click.native.prevent="deleteProduct">
                        Delete Product
                    </jet-danger-button>
                </div>
            </div>

        </template>

    </div>
</template>

<script>
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import JetDangerButton from '@/Jetstream/DangerButton'
import JetButton from '@/Jetstream/Button'

export default {
    components: {
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetButton,
        JetDangerButton
    },
    props: ['product', 'header', 'button', 'submitRoute', 'deletable', 'resetAfterSubmit'],
    data() {
        return {
            form: this.$inertia.form({
                _method: 'PUT',
                ...this.product
            }),

            photoPreview: this.product.image,
        }
    },

    methods: {
        submit() {

            if (this.$refs.photo) {
                this.form.image = this.$refs.photo.files[0]
            }


            this.form.post(route(this.submitRoute), {
                onSuccess: (msg) => {
                    if (msg.props.flash.success)
                        this.showAlert('success', msg.props.flash.success);
                    else if (msg.props.flash.info)
                        this.showAlert('info', msg.props.flash.info);

                    if (this.resetAfterSubmit)
                        this.resetForm()
                },
                onError: (msg) => {
                    this.showAlert('error', 'Check the data you entered for errors.')
                    console.log(msg)
                },
                preserveScroll: true
            });
        },

        selectNewPhoto() {
            this.$refs.photo.click();
        },

        resetForm() {
            this.form.name = ''
            this.form.image = null
            this.photoPreview = null
            this.form.description = ''
            this.form.qty = 1
            this.form.weight = 0.0
            this.form.price = 0
        },

        updatePhotoPreview() {
            const reader = new FileReader();

            reader.onload = (e) => {
                this.photoPreview = e.target.result;
            };

            reader.readAsDataURL(this.$refs.photo.files[0]);
        },

        deleteProduct() {

            this.$swal({
                icon: 'warning',
                title: "Delete this product?",
                text: "Are you sure? You won't be able to revert this.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DC2626",
                confirmButtonText: "Confirm"
            }).then((result) => {
                if (result.value) {

                    let deleteForm = this.$inertia.form({
                        _method: 'DELETE',
                        product_id: this.product.id
                    });

                    console.log(deleteForm)

                    deleteForm.post('/merchant/product/delete', {
                        preserveScroll: true,
                        onSuccess: (msg) => {

                            if (msg.props.flash.success)
                                this.showAlert('success', msg.props.flash.success);
                            else if (msg.props.flash.info)
                                this.showAlert('info', msg.props.flash.info);

                            this.$inertia.visit('/dashboard', {preserveState: true});


                        },
                        onError: (msg) => {
                            this.showAlert('error', msg.props.flash.error)

                        },
                    });

                }
            });


        }

    },
}
</script>

<style scoped>

</style>
