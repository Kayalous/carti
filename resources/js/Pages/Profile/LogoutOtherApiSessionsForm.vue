<template>
    <jet-action-section>
        <template #title>
            Mobile Sessions
        </template>

        <template #description>
            Manage and logout your active tokens on other devices.
        </template>

        <template #content>
            <div class="max-w-xl text-sm text-gray-600">
                If necessary, you may logout of all of your other tokens across all of your devices. If you feel your
                account has been compromised, you should also update your password.
            </div>

            <div class="mt-5 space-y-2" v-if="tokens.length > 0">
                <div class="flex items-center group w-full p-2 rounded hover:bg-gray-50" v-for="(token, i) in tokens"
                     :key="i">
                    <div>

                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2"
                             stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                             class="w-8 h-8 text-gray-500">
                            <path d="M0 0h24v24H0z" stroke="none"></path>
                            <rect x="7" y="4" width="10" height="16" rx="1"></rect>
                            <path d="M11 5h2M12 17v.01"></path>
                        </svg>
                    </div>

                    <div class="ml-3 flex items-center justify-between w-full">

                        <div>
                            <p class="text-sm text-gray-600">
                                {{ token.name }}
                            </p>
                            <p class="text-xs text-gray-700" v-if="token.last_used_at">Last used
                                <span class="text-green-500 font-semibold">{{
                                        new Date(token.last_used_at) | moment('from', 'now')
                                    }}</span>
                            </p>
                        </div>
                        <jet-button class="ml- transition duration-150 opacity-0 group-hover:opacity-100"
                                    @click.native="singleLogout(token)"
                                    :class="{ 'opacity-25': form.processing }">
                            Logout
                        </jet-button>
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-5">
                <jet-button @click.native="confirmLogout">
                    Logout All Devices
                </jet-button>

                <jet-action-message :on="form.recentlySuccessful" class="ml-3">
                    Done.
                </jet-action-message>
            </div>

            <!-- Logout All API Devices Confirmation Modal -->
            <jet-dialog-modal :show="confirmingLogout" @close="closeModal">
                <template #title>
                    Logout All Devices
                </template>

                <template #content>
                    Please enter your password to confirm you would like to logout of your mobile devices and current
                    carts.

                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                   ref="password"
                                   v-model="form.password"
                                   @keyup.enter.native="logoutAllApiSessions"/>

                        <jet-input-error :message="form.errors.password" class="mt-2"/>
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="closeModal">
                        Nevermind
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click.native="logoutAllApiSessions"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Logout All Devices
                    </jet-button>
                </template>
            </jet-dialog-modal>

            <!-- Logout Single API Device Confirmation Modal -->
            <jet-dialog-modal :show="confirmingSingleLogout" @close="closeSingleModal">
                <template #title>
                    Logout {{ currentLogoutDevice.name }}?
                </template>

                <template #content>
                    Please enter your password to confirm you would like to logout of '{{ currentLogoutDevice.name }}'.

                    <div class="mt-4">
                        <jet-input type="password" class="mt-1 block w-3/4" placeholder="Password"
                                   ref="password"
                                   v-model="form.password"
                                   @keyup.enter.native="logoutAllApiSessions"/>

                        <jet-input-error :message="form.errors.password" class="mt-2"/>
                    </div>
                </template>

                <template #footer>
                    <jet-secondary-button @click.native="closeSingleModal">
                        Nevermind
                    </jet-secondary-button>

                    <jet-button class="ml-2" @click.native="logoutApiSession"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Logout
                    </jet-button>
                </template>
            </jet-dialog-modal>
        </template>
    </jet-action-section>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetActionSection from '@/Jetstream/ActionSection'
import JetButton from '@/Jetstream/Button'
import JetDialogModal from '@/Jetstream/DialogModal'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import 'vue-moment'

export default {
    props: ['tokens'],

    components: {
        JetActionMessage,
        JetActionSection,
        JetButton,
        JetDialogModal,
        JetInput,
        JetInputError,
        JetSecondaryButton,
    },

    data() {
        return {
            confirmingLogout: false,
            confirmingSingleLogout: false,
            currentLogoutDevice: {},
            form: this.$inertia.form({
                password: '',
                token_id: ''
            })
        }
    },


    methods: {
        confirmLogout() {
            this.confirmingLogout = true

            setTimeout(() => this.$refs.password.focus(), 250)
        },

        singleLogout(device) {
            this.currentLogoutDevice = device;
            this.form.token_id = device.id
            this.confirmingSingleLogout = true
            setTimeout(() => this.$refs.password.focus(), 250)
        },

        logoutAllApiSessions() {
            this.form.delete(route('all-api-tokens.destroy'), {
                preserveScroll: true,
                onSuccess: () => this.closeModal(),
                onError: () => this.$refs.password.focus(),
                onFinish: () => this.form.reset(),
            })
        },
        logoutApiSession() {
            this.form.delete(route('api-token.deleteApiToken'), {
                preserveScroll: true,
                onSuccess: () => this.closeSingleModal(),
                onError: () => this.$refs.password.focus(),
            })

        },

        closeModal() {
            this.confirmingLogout = false

            this.form.reset()
        },

        closeSingleModal() {
            this.confirmingSingleLogout = false

            this.form.reset()
        },
    },
}
</script>
