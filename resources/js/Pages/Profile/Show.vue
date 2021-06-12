<template>
    <app-layout gray>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Profile
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                    <update-profile-information-form :user="$page.props.user"/>

                    <jet-section-border/>
                </div>

                <div v-if="$page.props.jetstream.canUpdatePassword">
                    <update-password-form class="mt-10 sm:mt-0"/>

                    <jet-section-border/>
                </div>

                <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                    <two-factor-authentication-form class="mt-10 sm:mt-0"/>

                    <jet-section-border/>
                </div>

                <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0"/>

                <jet-section-border/>


                <logout-other-api-sessions-form :tokens="tokens" class="mt-10 sm:mt-0"/>


                <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                    <jet-section-border/>

                    <delete-user-form class="mt-10 sm:mt-0"/>
                </template>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import DeleteUserForm from './DeleteUserForm'
import JetSectionBorder from '@/Jetstream/SectionBorder'
import LogoutOtherBrowserSessionsForm from './LogoutOtherBrowserSessionsForm'
import LogoutOtherApiSessionsForm from './LogoutOtherApiSessionsForm'
import TwoFactorAuthenticationForm from './TwoFactorAuthenticationForm'
import UpdatePasswordForm from './UpdatePasswordForm'
import UpdateProfileInformationForm from './UpdateProfileInformationForm'

export default {
    props: ['sessions', 'tokens'],

    components: {
        AppLayout,
        DeleteUserForm,
        JetSectionBorder,
        LogoutOtherBrowserSessionsForm,
        LogoutOtherApiSessionsForm,
        TwoFactorAuthenticationForm,
        UpdatePasswordForm,
        UpdateProfileInformationForm,
    },
}
</script>
